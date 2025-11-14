# Test des ressources statiques
Write-Host "TEST DES RESSOURCES STATIQUES" -ForegroundColor Green
Write-Host "==============================" -ForegroundColor Green

$baseUrl = "https://127.0.0.1:8000"
$resources = @(
    "/assets/app-*.js",
    "/assets/styles/app-*.css"
)

# Test de taille des bundles
Write-Host "Analyse des bundles generes..." -ForegroundColor Cyan

try {
    $homePage = Invoke-WebRequest -Uri "$baseUrl/" -ErrorAction Stop
    $cssLinks = $homePage.Content | Select-String -Pattern 'href="([^"]*\.css[^"]*)"' -AllMatches
    $jsLinks = $homePage.Content | Select-String -Pattern 'src="([^"]*\.js[^"]*)"' -AllMatches
    
    Write-Host "CSS detectes:" -ForegroundColor Yellow
    foreach ($match in $cssLinks.Matches) {
        $url = $match.Groups[1].Value
        if ($url -like "/assets/*") {
            try {
                $time = Measure-Command { 
                    $response = Invoke-WebRequest -Uri "$baseUrl$url" -ErrorAction Stop
                }
                $sizeKB = [math]::Round($response.Content.Length / 1024, 2)
                Write-Host "  $url : $sizeKB KB ($([math]::Round($time.TotalMilliseconds, 2))ms)" -ForegroundColor Gray
            }
            catch {
                Write-Host "  $url : ERREUR" -ForegroundColor Red
            }
        }
    }
    
    Write-Host "JavaScript detectes:" -ForegroundColor Yellow
    foreach ($match in $jsLinks.Matches) {
        $url = $match.Groups[1].Value
        if ($url -like "/assets/*") {
            try {
                $time = Measure-Command { 
                    $response = Invoke-WebRequest -Uri "$baseUrl$url" -ErrorAction Stop
                }
                $sizeKB = [math]::Round($response.Content.Length / 1024, 2)
                Write-Host "  $url : $sizeKB KB ($([math]::Round($time.TotalMilliseconds, 2))ms)" -ForegroundColor Gray
            }
            catch {
                Write-Host "  $url : ERREUR" -ForegroundColor Red
            }
        }
    }
}
catch {
    Write-Host "Erreur lors de l'analyse des ressources" -ForegroundColor Red
}