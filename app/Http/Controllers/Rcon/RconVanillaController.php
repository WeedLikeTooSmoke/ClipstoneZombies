<?php

namespace App\Http\Controllers\Rcon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use q3tool;

class RconVanillaController extends Controller
{
    public function sendCommand(Request $request)
    {
        $tool = new q3tool("127.0.0.1", 4977, "weston123", "");
        $tool->send_rcon($_POST['command']);

        return redirect("admin/console");
    }
}
