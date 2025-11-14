# Script de benchmark complet avec gestion du serveur Symfony
Write-Host "=== BENCHMARK PERFORMANCE COMPLETE ===" -ForegroundColor Green

# Configuration
$symfonyPath = "c:\laragon\www\cours_PHP"
$baseUrl = "http://localhost:8000"
$pages = @(
    @{ name = "Accueil"; url = "$baseUrl/" },
    @{ name = "Variables"; url = "$baseUrl/variables" },
    @{ name = "Operateurs"; url = "$baseUrl/operateurs" },
    @{ name = "Typages"; url = "$baseUrl/typages" },
    @{ name = "Structures"; url = "$baseUrl/structure/controle" },
    @{ name = "POO"; url = "$baseUrl/poo" },
    @{ name = "Fonctions"; url = "$baseUrl/fonction/p/h/p" },
    @{ name = "BDD"; url = "$baseUrl/bdd" },
    @{ name = "Infrastructure"; url = "$baseUrl/infrastructure" }
)

# Démarrer le serveur Symfony en arrière-plan
Write-Host "Démarrage du serveur Symfony..." -ForegroundColor Yellow
$serverJob = Start-Job -ScriptBlock {
    Set-Location "c:\laragon\www\cours_PHP"
    symfony server:start --port=8000 --no-interaction
}

# Attendre que le serveur soit prêt
Write-Host "Attente du démarrage du serveur..." -ForegroundColor Yellow
Start-Sleep -Seconds 5

# Tester la connexion
$maxRetries = 10
$retryCount = 0
do {
    try {
        $response = Invoke-WebRequest -Uri $baseUrl -TimeoutSec 5 -ErrorAction Stop
        Write-Host "Serveur prêt!" -ForegroundColor Green
        break
    }
    catch {
        $retryCount++
        Write-Host "Tentative $retryCount/$maxRetries..." -ForegroundColor Yellow
        Start-Sleep -Seconds 2
    }
} while ($retryCount -lt $maxRetries)

if ($retryCount -eq $maxRetries) {
    Write-Host "Impossible de se connecter au serveur Symfony" -ForegroundColor Red
    Stop-Job -Job $serverJob
    Remove-Job -Job $serverJob
    exit 1
}

# Tests de performance
Write-Host "`n=== CACHE FROID (première requête) ===" -ForegroundColor Cyan
$coldCacheTimes = @{}
foreach ($page in $pages) {
    try {
        $time = Measure-Command {
            $response = Invoke-WebRequest -Uri $page.url -TimeoutSec 30
        }
        $coldCacheTimes[$page.name] = $time.TotalMilliseconds
        Write-Host "$($page.name): $([math]::Round($time.TotalMilliseconds, 2))ms" -ForegroundColor White
    }
    catch {
        Write-Host "$($page.name): ERREUR - $($_.Exception.Message)" -ForegroundColor Red
    }
}

Write-Host "`n=== CACHE CHAUD (5 requêtes moyennées) ===" -ForegroundColor Cyan
$warmCacheTimes = @{}
foreach ($page in $pages) {
    $times = @()
    for ($i = 1; $i -le 5; $i++) {
        try {
            $time = Measure-Command {
                $response = Invoke-WebRequest -Uri $page.url -TimeoutSec 30
            }
            $times += $time.TotalMilliseconds
        }
        catch {
            Write-Host "Erreur sur $($page.name) (tentative $i): $($_.Exception.Message)" -ForegroundColor Red
        }
    }
    if ($times.Count -gt 0) {
        $average = ($times | Measure-Object -Average).Average
        $warmCacheTimes[$page.name] = $average
        Write-Host "$($page.name): $([math]::Round($average, 2))ms (min: $([math]::Round(($times | Measure-Object -Minimum).Minimum, 2))ms, max: $([math]::Round(($times | Measure-Object -Maximum).Maximum, 2))ms)" -ForegroundColor White
    }
}

# Statistiques finales
Write-Host "`n=== STATISTIQUES FINALES ===" -ForegroundColor Green
if ($coldCacheTimes.Count -gt 0) {
    $avgCold = ($coldCacheTimes.Values | Measure-Object -Average).Average
    Write-Host "Moyenne cache froid: $([math]::Round($avgCold, 2))ms" -ForegroundColor White
}
if ($warmCacheTimes.Count -gt 0) {
    $avgWarm = ($warmCacheTimes.Values | Measure-Object -Average).Average
    Write-Host "Moyenne cache chaud: $([math]::Round($avgWarm, 2))ms" -ForegroundColor White
    
    if ($coldCacheTimes.Count -gt 0) {
        $improvement = (($avgCold - $avgWarm) / $avgCold) * 100
        Write-Host "Amélioration avec cache: $([math]::Round($improvement, 2))%" -ForegroundColor Green
    }
}

# Test des assets statiques
Write-Host "`n=== PERFORMANCE DES ASSETS ===" -ForegroundColor Cyan
$assetUrls = @(
    "$baseUrl/assets/styles/app-UWHWMHVA.css",
    "$baseUrl/assets/app-BGS5DUXB.js"
)

foreach ($assetUrl in $assetUrls) {
    try {
        $time = Measure-Command {
            $response = Invoke-WebRequest -Uri $assetUrl -TimeoutSec 10
        }
        $size = $response.Content.Length
        Write-Host "$(Split-Path $assetUrl -Leaf): $([math]::Round($time.TotalMilliseconds, 2))ms ($([math]::Round($size/1KB, 2))KB)" -ForegroundColor White
    }
    catch {
        Write-Host "$(Split-Path $assetUrl -Leaf): ERREUR - $($_.Exception.Message)" -ForegroundColor Red
    }
}

# Arrêter le serveur
Write-Host "`nArrêt du serveur Symfony..." -ForegroundColor Yellow
Stop-Job -Job $serverJob -ErrorAction SilentlyContinue
Remove-Job -Job $serverJob -ErrorAction SilentlyContinue

Write-Host "`n=== BENCHMARK TERMINÉ ===" -ForegroundColor Green