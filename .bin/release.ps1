# Release script: bump theme version, commit, tag, push
# Usage:
#   ./bin/release.ps1              # auto bump patch version
#   ./bin/release.ps1 0.1.39       # set explicit version

param(
  [Parameter(Position=0)]
  [string]$Version
)

Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'

# Ensure we run from repo root (where style.css lives)
$root = Split-Path -Parent $MyInvocation.MyCommand.Path
$repo = Split-Path -Parent $root
Set-Location $repo

$style = Join-Path $repo 'style.css'
if (-not (Test-Path $style)) {
  throw "style.css not found at repo root: $style"
}

$content = Get-Content -Raw -Path $style
$match = [regex]::Match($content, '^[ \t]*Version:\s*(\d+)\.(\d+)\.(\d+)\s*$', [System.Text.RegularExpressions.RegexOptions]::Multiline)
if (-not $match.Success) {
  throw "Could not find a Version line in style.css"
}

$major = [int]$match.Groups[1].Value
$minor = [int]$match.Groups[2].Value
$patch = [int]$match.Groups[3].Value

if ([string]::IsNullOrWhiteSpace($Version)) {
  $patch++
  $Version = "$major.$minor.$patch"
}

# Basic format guard
if ($Version -notmatch '^\d+\.\d+\.\d+$') {
  throw "Invalid version format: $Version"
}

$newContent = [regex]::Replace(
  $content,
  '^[ \t]*Version:\s*\d+\.\d+\.\d+\s*$',
  "Version: $Version",
  [System.Text.RegularExpressions.RegexOptions]::Multiline
)

if ($newContent -eq $content) {
  throw "Version line was not updated."
}

Set-Content -Path $style -Value $newContent -NoNewline

# Git workflow
& git add -A
& git commit -m "Bump version to $Version"
& git tag -a "v$Version" -m "v$Version"
& git push --follow-tags

Write-Host "Released v$Version"