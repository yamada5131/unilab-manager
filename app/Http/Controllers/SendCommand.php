<?php

namespace App\Http\Controllers;

use App\Jobs\SendCommandToAgent;
use Illuminate\Http\Request;

class SendCommand extends Controller
{
    public function sendCommand(Request $request, $agentId)
    {
        $command = [
            'action' => $request->input('action', 'default_action'), // Ví dụ: 'shutdown', 'install_software'
            'data' => $request->input('data', []), // Dữ liệu bổ sung cho lệnh
        ];

        dispatch(new SendCommandToAgent($agentId, $command));

        return response()->json([
            'status' => 'success',
            'message' => "Command sent to agent $agentId",
        ]);
    }
}
