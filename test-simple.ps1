# Test de performance simple
Write-Host "=== TEST ASSETS ===" -ForegroundColor Green

# Demarrer serveur
symfony server:start --port=8001 --daemon | Out-Null
Start-Sleep -Seconds 3

try {
    # Test de base
    $response = Invoke-WebRequest -Uri "http://127.0.0.1:8001/" -TimeoutSec 10
    Write-Host "Server OK" -ForegroundColor Green
    
    # Chercher les assets
    $html = $response.Content
    $cssCount = ([regex]::Matches($html, 'assets.*\.css')).Count
    $jsCount = ([regex]::Matches($html, 'assets.*\.js')).Count
    
    Write-Host "CSS files: $cssCount" -ForegroundColor White
    Write-Host "JS files: $jsCount" -ForegroundColor White
    
    # Test performance
    $time = Measure-Command { Invoke-WebRequest -Uri "http://127.0.0.1:8001/variables" }
    Write-Host "Variables page: $([math]::Round($time.TotalMilliseconds, 2))ms" -ForegroundColor White
    
    $time = Measure-Command { Invoke-WebRequest -Uri "http://127.0.0.1:8001/poo" }
    Write-Host "POO page: $([math]::Round($time.TotalMilliseconds, 2))ms" -ForegroundColor White
}
catch {
    Write-Host "Error: $($_.Exception.Message)" -ForegroundColor Red
}

# Arreter serveur
symfony server:stop | Out-Null
Write-Host "Test complete" -ForegroundColor Green