$files = Get-ChildItem -Path "c:\Users\yamini\Desktop\media\mediadynamic\app\Filament\Resources" -Recurse -Filter "*.php"

foreach ($file in $files) {
    $content = Get-Content $file.FullName -Raw
    $original = $content

    # Remove ->visibleFrom('md') entirely (do not touch the trailing commas or whitespace!)
    $content = $content -replace "->visibleFrom\('md'\)", ""

    # Remove the massive mobile card layout block
    $pattern = '(?s)[ \t]*// MOBILE CARD.*?hiddenFrom\(''md''\)[^,]*,\r?\n?'
    $content = $content -replace $pattern, ""

    if ($original -ne $content) {
        Write-Host "Modified $($file.Name)"
        Set-Content -Path $file.FullName -Value $content -NoNewline
    }
}
