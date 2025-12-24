<?php
namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class Proxy extends BaseController
{
    /**
     * Forward incoming request to another endpoint.
     * Usage (examples):
     *  - GET /proxy?url=/some/internal/route
     *  - POST /proxy with header X-Target-URL: /api/submit
     * Notes:
     *  - For safety, relative paths (starting with '/') are preferred and resolved
     *    against the current host. Absolute external URLs are allowed but be careful.
     */
    public function forward()
    {
        $req = $this->request;

        // Accept target via `url` query param or `X-Target-URL` header
        $target = $req->getGet('url') ?? $req->getHeaderLine('X-Target-URL');

        if (empty($target)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'target url required (query `url` or header `X-Target-URL`)']);
        }

        // Resolve relative paths to the current host
        if (strpos($target, '/') === 0) {
            $scheme = (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
            $host   = $_SERVER['HTTP_HOST'] ?? ($_SERVER['SERVER_NAME'] ?? 'localhost');
            $url    = $scheme . '://' . $host . $target;
        } else {
            $url = $target;
        }

        // Only allow simple forwarding to keep behaviour explicit: copy method, query and raw body.
        $method = $req->getMethod();

        $options = [
            'query' => $req->getGet(),
            'body'  => $req->getBody(),
            'headers' => [
                'Accept' => $req->getHeaderLine('Accept') ?: 'application/json',
            ],
            // disable strict SSL verification in dev; change for production
            'verify' => false,
        ];

        $client = \Config\Services::curlrequest();

        try {
            $res = $client->request($method, $url, $options);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(502)->setJSON(['error' => 'upstream request failed', 'message' => $e->getMessage()]);
        }

        // Mirror status, content-type and body from upstream
        $status  = $res->getStatusCode();
        $ctype   = $res->getHeaderLine('Content-Type') ?: 'text/plain';
        $body    = $res->getBody();

        return $this->response->setStatusCode($status)->setContentType($ctype)->setBody($body);
    }
}
