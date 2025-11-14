# Script de Benchmark pour l'application Cours PHP
param(
    [int]$Iterations = 5,
    [string]$BaseUrl = "https://127.0.0.1:8000"
)

Write-Host "BENCHMARK APPLICATION COURS PHP" -ForegroundColor Green
Write-Host "===============================" -ForegroundColor Green

$pages = @(
    @{ Name = "Accueil"; Url = "/" },
    @{ Name = "Variables"; Url = "/variables" },
    @{ Name = "Types"; Url = "/typages" },
    @{ Name = "Operateurs"; Url = "/operateurs" },
    @{ Name = "POO"; Url = "/poo" },
    @{ Name = "BDD"; Url = "/bdd" },
    @{ Name = "Glossaire"; Url = "/glossaire" }
)

$results = @()

foreach ($page in $pages) {
    Write-Host "Test de performance: $($page.Name)" -ForegroundColor Cyan
    
    $times = @()
    $errors = 0
    
    for ($i = 1; $i -le $Iterations; $i++) {
        try {
            $time = Measure-Command { 
                $response = Invoke-WebRequest -Uri "$BaseUrl$($page.Url)" -ErrorAction Stop
            }
            $times += $time.TotalMilliseconds
            Write-Host "  Test $i : $([math]::Round($time.TotalMilliseconds, 2))ms" -ForegroundColor Gray
        }
        catch {
            $errors++
            Write-Host "  Test $i : ERREUR" -ForegroundColor Red
        }
    }
    
    if ($times.Count -gt 0) {
        $avg = ($times | Measure-Object -Average).Average
        $min = ($times | Measure-Object -Minimum).Minimum
        $max = ($times | Measure-Object -Maximum).Maximum
        
        $results += [PSCustomObject]@{
            Page    = $page.Name
            AvgTime = [math]::Round($avg, 2)
            MinTime = [math]::Round($min, 2)
            MaxTime = [math]::Round($max, 2)
            Errors  = $errors
        }
        
        Write-Host "  Moyenne: $([math]::Round($avg, 2))ms" -ForegroundColor Yellow
    }
    
    Write-Host ""
}

Write-Host "RESULTATS COMPLETS" -ForegroundColor Green
Write-Host "==================" -ForegroundColor Green
$results | Format-Table -AutoSize

$avgOverall = ($results | ForEach-Object { $_.AvgTime } | Measure-Object -Average).Average
Write-Host "Temps moyen global : $([math]::Round($avgOverall, 2))ms" -ForegroundColor Green

$fastestPage = $results | Sort-Object AvgTime | Select-Object -First 1
$slowestPage = $results | Sort-Object AvgTime -Descending | Select-Object -First 1

Write-Host "Page la plus rapide : $($fastestPage.Page) ($($fastestPage.AvgTime)ms)" -ForegroundColor Green
Write-Host "Page la plus lente : $($slowestPage.Page) ($($slowestPage.AvgTime)ms)" -ForegroundColor Yellow