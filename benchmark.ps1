# Script de Benchmark PowerShell pour l'application Cours PHP
# Test des performances de l'architecture modulaire

param(
    [int]$Iterations = 10,
    [string]$BaseUrl = "https://127.0.0.1:8000"
)

Write-Host "🚀 BENCHMARK APPLICATION COURS PHP" -ForegroundColor Green
Write-Host "=====================================" -ForegroundColor Green
Write-Host ""

# Pages à tester
$pages = @(
    @{ Name = "Accueil"; Url = "/" },
    @{ Name = "Variables"; Url = "/variables" },
    @{ Name = "Types"; Url = "/typages" },
    @{ Name = "Opérateurs"; Url = "/operateurs" },
    @{ Name = "POO"; Url = "/poo" },
    @{ Name = "BDD"; Url = "/bdd" },
    @{ Name = "Glossaire"; Url = "/glossaire" }
)

$results = @()

foreach ($page in $pages) {
    Write-Host "📊 Test de performance: $($page.Name)" -ForegroundColor Cyan
    
    $times = @()
    $errors = 0
    
    for ($i = 1; $i -le $Iterations; $i++) {
        try {
            $time = Measure-Command { 
                $response = Invoke-WebRequest -Uri "$BaseUrl$($page.Url)" -ErrorAction Stop
                if ($response.StatusCode -ne 200) {
                    throw "HTTP $($response.StatusCode)"
                }
            }
            $times += $time.TotalMilliseconds
            Write-Host "  ✓ Test $i : $([math]::Round($time.TotalMilliseconds, 2))ms" -ForegroundColor Gray
        }
        catch {
            $errors++
            Write-Host "  ✗ Test $i : ERREUR - $($_.Exception.Message)" -ForegroundColor Red
        }
    }
    
    if ($times.Count -gt 0) {
        $avg = ($times | Measure-Object -Average).Average
        $min = ($times | Measure-Object -Minimum).Minimum
        $max = ($times | Measure-Object -Maximum).Maximum
        
        $results += [PSCustomObject]@{
            Page        = $page.Name
            Url         = $page.Url
            AvgTime     = [math]::Round($avg, 2)
            MinTime     = [math]::Round($min, 2)
            MaxTime     = [math]::Round($max, 2)
            Errors      = $errors
            SuccessRate = [math]::Round(($times.Count / $Iterations) * 100, 1)
        }
        
        Write-Host "  📈 Moyenne: $([math]::Round($avg, 2))ms | Min: $([math]::Round($min, 2))ms | Max: $([math]::Round($max, 2))ms" -ForegroundColor Yellow
    }
    else {
        $results += [PSCustomObject]@{
            Page        = $page.Name
            Url         = $page.Url
            AvgTime     = "N/A"
            MinTime     = "N/A"
            MaxTime     = "N/A"
            Errors      = $errors
            SuccessRate = 0
        }
    }
    
    Write-Host ""
}

Write-Host "📋 RÉSULTATS COMPLETS" -ForegroundColor Green
Write-Host "=====================" -ForegroundColor Green
$results | Format-Table -AutoSize

Write-Host "🎯 ANALYSE DES PERFORMANCES" -ForegroundColor Magenta
Write-Host "============================" -ForegroundColor Magenta

$avgOverall = ($results | Where-Object { $_.AvgTime -ne "N/A" } | ForEach-Object { $_.AvgTime } | Measure-Object -Average).Average
$fastestPage = $results | Where-Object { $_.AvgTime -ne "N/A" } | Sort-Object AvgTime | Select-Object -First 1
$slowestPage = $results | Where-Object { $_.AvgTime -ne "N/A" } | Sort-Object AvgTime -Descending | Select-Object -First 1

Write-Host "⚡ Temps moyen global : $([math]::Round($avgOverall, 2))ms" -ForegroundColor Green
Write-Host "🏆 Page la plus rapide : $($fastestPage.Page) ($($fastestPage.AvgTime)ms)" -ForegroundColor Green
Write-Host "🐌 Page la plus lente : $($slowestPage.Page) ($($slowestPage.AvgTime)ms)" -ForegroundColor Yellow

$totalErrors = ($results | ForEach-Object { $_.Errors } | Measure-Object -Sum).Sum
$totalTests = $Iterations * $pages.Count
$globalSuccessRate = [math]::Round((($totalTests - $totalErrors) / $totalTests) * 100, 1)

Write-Host "✅ Taux de succès global : $globalSuccessRate%" -ForegroundColor Green
Write-Host "❌ Erreurs totales : $totalErrors/$totalTests" -ForegroundColor $(if ($totalErrors -eq 0) { "Green" } else { "Red" })

Write-Host ""
Write-Host "🔧 RECOMMANDATIONS" -ForegroundColor Blue
Write-Host "==================" -ForegroundColor Blue

if ($avgOverall -lt 500) {
    Write-Host "✅ Excellentes performances ! Architecture modulaire efficace." -ForegroundColor Green
}
elseif ($avgOverall -lt 1000) {
    Write-Host "✅ Bonnes performances. Architecture stable." -ForegroundColor Yellow
}
else {
    Write-Host "⚠️  Performances à optimiser. Considérer le cache." -ForegroundColor Red
}

if ($globalSuccessRate -eq 100) {
    Write-Host "✅ Application stable, aucune erreur détectée." -ForegroundColor Green
}
else {
    Write-Host "⚠️  $totalErrors erreurs détectées, vérifier les logs." -ForegroundColor Red
}

Write-Host ""
Write-Host "📊 Test terminé avec $Iterations itérations par page" -ForegroundColor Gray