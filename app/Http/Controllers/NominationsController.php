<?php

namespace App\Http\Controllers;

use App\Models\Nomination;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class NominationsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            //'role_or_permission:super-admin|edit articles',
            new Middleware('role:super-admin|administrator|volunteer', only: ['index']),
            new Middleware('role:super-admin|administrator|volunteer', only: ['viewEntry']),
            new Middleware('role:super-admin|administrator', only: ['destroy']),
            //new Middleware(\Spatie\Permission\Middleware\RoleMiddleware::using('super-admin'), except: ['viewEntry']),
            //new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using('delete nomination,web'), only: ['destroy']),
        ];
    }

    public function index()
    {
        $nominations = Nomination::all();
        return view('nominations.index', [
            'nominations' => $nominations,
        ]);
    }

    public function destroy($nominationId)
    {
        $nominationEntry = Nomination::find($nominationId);
        if ($nominationEntry != null) {
            $nominationEntry->delete();
            return redirect()->route('nominations.index')->with(['status' => 'Nomination Entry Deleted Successfully']);
        }

        return redirect('nominations.index')->with('status', 'Nomination Entry Deleted Successfully');
    }

    public function viewEntry($nominationId)
    {
        $nominationEntry = Nomination::find($nominationId);

        return view('nominations.view', [
            'nominationEntry' => $nominationEntry
        ]);
    }
}
