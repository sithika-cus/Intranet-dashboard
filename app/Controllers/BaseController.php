<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
    }

    // ── Check single permission ──────────────────────────
    // Usage: $this->can('edit'), $this->can('add')
    protected function can(string $action): bool
    {
        // Admin always has full access
        if (session()->get('role') === 'admin') return true;

        $perms = session()->get('permissions') ?? [];
        return (bool)($perms['can_' . $action] ?? false);
    }

    // ── Block controller action if no permission ─────────
    // Usage: if ($deny = $this->requirePermission('delete')) return $deny;
    protected function requirePermission(string $action)
    {
        if (!$this->can($action)) {
            return $this->response
                        ->setJSON(['error' => 'Permission denied'])
                        ->setStatusCode(403);
        }
        return null;
    }

    // ── Smart view responder ─────────────────────────────
    // AJAX request  → return just the fragment
    // Direct hit    → return full layout with fragment inside
    protected function respondView(string $view, array $data = [])
    {
        // Build permissions for the view
        $perms = session()->get('permissions') ?? [
            'can_add'    => false,
            'can_edit'   => false,
            'can_delete' => false,
            'can_view'   => false,
        ];

        // Admin always gets everything
        if (session()->get('role') === 'admin') {
            $perms = [
                'can_add'    => true,
                'can_edit'   => true,
                'can_delete' => true,
                'can_view'   => true,
            ];
        }

        // Inject into every view automatically
        $data['perms']   = $perms;
        $data['isAdmin'] = session()->get('role') === 'admin';

        if ($this->request->isAJAX()) {
            // Loaded via $.load() — return just the fragment
            return view($view, $data);
        }

        // Direct browser hit (refresh / paste URL)
        // Render fragment first then wrap in full layout
        $data['content_html'] = view($view, $data);
        return view('dashboard', $data);
    }
}