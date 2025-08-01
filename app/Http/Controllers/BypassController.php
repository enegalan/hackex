<?php

namespace App\Http\Controllers;

use App\Models\Bypass;
use Illuminate\Http\Request;

class BypassController extends Controller {
    public static function checkAndUpdateBypass(Bypass $bypass) {
        if ($bypass->status === 0 && now()->greaterThanOrEqualTo($bypass->expires_at)) {
            // Ha expirado, calcular si tuvo éxito o no
            $successChance = self::calculateSuccessChance(
                $bypass->User['bypasser_level'],
                $bypass->Victim['firewall_level']
            );
            $bypass->status = rand(1, 100) <= $successChance ? 1 : 2; // 1 = success, 2 = failed
            $bypass->save();
        }
        return $bypass;
    }
    static function calculateSuccessChance(int $bypasserLevel, int $firewallLevel): int {
        // Diferencia de niveles
        $diff = $firewallLevel - $bypasserLevel;

        // Penalizador por nivel del bypasser (cuanto más alto, más difícil)
        $progressPenalty = min(0.5, $bypasserLevel * 0.02); // hasta -50%

        // Base chance cuando niveles son iguales
        $baseChance = 90;

        // Modificador según la diferencia de niveles
        // Si diff > 0 (firewall más alto), reducir chance
        // Si diff < 0 (bypasser más alto), aumentar chance
        $levelModifier = -($diff * 8); // 8% por nivel de diferencia

        // Aplicar penalización por progreso (niveles altos tienen menos chance)
        $adjustedChance = ($baseChance + $levelModifier) * (1 - $progressPenalty);

        // Limitar entre 5 y 95%
        return max(5, min(95, round($adjustedChance)));
    }
}
