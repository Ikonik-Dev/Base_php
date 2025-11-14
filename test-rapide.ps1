# Test de performance rapide
Write-Host "=== TEST RAPIDE DES ASSETS ===" -ForegroundColor Green

# Démarrer le serveur sur un port différent
Write-Host "Démarrage du serveur sur le port 8001..." -ForegroundColor Yellow
$serverJob = Start-Job -ScriptBlock {
    Set-Location "c:\laragon\www\cours_PHP"
    symfony server:start --port=8001 --no-interaction --no-debug 2>$null
}

Start-Sleep -Seconds 3

# Test de base
try {
    Write-Host "Test de connexion..." -ForegroundColor Yellow
    $response = Invoke-WebRequest -Uri "http://127.0.0.1:8001/" -TimeoutSec 10
    Write-Host "✓ Serveur accessible" -ForegroundColor Green
    
    # Vérifier les assets dans le HTML
    Write-Host "`nRécupération du contenu HTML..." -ForegroundColor Yellow
    $htmlContent = $response.Content
    
    # Recherche des balises link et script
    $cssLinks = [regex]::Matches($htmlContent, '<link[^>]*href="[^"]*assets[^"]*\.css[^"]*"[^>]*>')
    $jsScripts = [regex]::Matches($htmlContent, '<script[^>]*src="[^"]*assets[^"]*\.js[^"]*"[^>]*>')
    
    Write-Host "`n=== ANALYSE DES ASSETS ===" -ForegroundColor Cyan
    Write-Host "Fichiers CSS trouvés: $($cssLinks.Count)" -ForegroundColor White
    foreach ($match in $cssLinks) {
        Write-Host "  $($match.Value)" -ForegroundColor Gray
    }
    
    Write-Host "Fichiers JS trouvés: $($jsScripts.Count)" -ForegroundColor White
    foreach ($match in $jsScripts) {
        Write-Host "  $($match.Value)" -ForegroundColor Gray
    }
    
    # Test de performance simple
    Write-Host "`n=== TEST DE PERFORMANCE ===" -ForegroundColor Cyan
    $time = Measure-Command {
        $testResponse = Invoke-WebRequest -Uri "http://127.0.0.1:8001/variables" -TimeoutSec 10
    }
    Write-Host "Page Variables: $([math]::Round($time.TotalMilliseconds, 2))ms" -ForegroundColor White
    
    $time = Measure-Command {
        $testResponse = Invoke-WebRequest -Uri "http://127.0.0.1:8001/poo" -TimeoutSec 10
    }
    Write-Host "Page POO: $([math]::Round($time.TotalMilliseconds, 2))ms" -ForegroundColor White
    
}
catch {
    Write-Host "Erreur: $($_.Exception.Message)" -ForegroundColor Red
}
finally {
    # Nettoyer
    Write-Host "`nArrêt du serveur..." -ForegroundColor Yellow
    Stop-Job -Job $serverJob -ErrorAction SilentlyContinue
    Remove-Job -Job $serverJob -ErrorAction SilentlyContinue
}

Write-Host "`n=== TEST TERMINÉ ===" -ForegroundColor Green