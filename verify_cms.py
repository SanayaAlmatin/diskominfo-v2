import subprocess
import json
import os

php = r'c:\laragon\bin\php\php-8.4.18-Win32-vs17-x64\php.exe'
cwd = r'c:\laragon\www\diskominfo-v2.worktrees\copilot-dynamic-footer-content-cms-integration'

print('=' * 70)
print('FOOTER CMS IMPLEMENTATION VERIFICATION')
print('=' * 70)

# Check 1: Artisan version
print('\n[1] Checking artisan --version')
try:
    result = subprocess.run([php, 'artisan', '--version'], cwd=cwd, capture_output=True, text=True, timeout=60)
    if result.returncode == 0:
        version = result.stdout.strip()
        print(f'✓ Artisan works: {version}')
    else:
        print(f'✗ Artisan failed: {result.stderr}')
except Exception as e:
    print(f'✗ Error: {e}')

# Check 2: Footer routes
print('\n[2] Checking footer routes')
try:
    result = subprocess.run([php, 'artisan', 'route:list', '--name=footer'], cwd=cwd, capture_output=True, text=True, timeout=60)
    if result.returncode == 0:
        output = result.stdout.strip()
        # Count the number of routes (lines with METHOD)
        lines = output.split('\n')
        route_count = len([l for l in lines if 'GET' in l or 'POST' in l or 'PUT' in l or 'DELETE' in l or 'PATCH' in l])
        print(f'✓ Routes found: {route_count}')
        print('  Routes output:')
        for line in output.split('\n')[-20:]:
            if line.strip():
                print(f'    {line}')
    else:
        print(f'✗ Route list failed: {result.stderr}')
except Exception as e:
    print(f'✗ Error: {e}')

# Check 3: Migration status
print('\n[3] Checking migration status')
try:
    result = subprocess.run([php, 'artisan', 'migrate:status'], cwd=cwd, capture_output=True, text=True, timeout=60)
    if result.returncode == 0:
        output = result.stdout.strip()
        # Find the footer migration line
        for line in output.split('\n'):
            if 'tm_footer_tables' in line:
                print(f'✓ Footer migration: {line}')
                break
        else:
            print('✗ Footer migration not found in migration status')
            print('  Full output:')
            for line in output.split('\n')[-15:]:
                if line.strip():
                    print(f'    {line}')
    else:
        print(f'✗ Migration status failed: {result.stderr}')
except Exception as e:
    print(f'✗ Error: {e}')

# Check 4: Database data
print('\n[4] Checking tm_footer_settings table data')
try:
    php_code = "require 'vendor/autoload.php'; $app = require 'bootstrap/app.php'; $app->make('Illuminate\\\\Contracts\\\\Console\\\\Kernel')->bootstrap(); echo json_encode(\\App\\Models\\TmFooterSetting::first());"
    result = subprocess.run([php, '-r', php_code], cwd=cwd, capture_output=True, text=True, timeout=60)
    if result.returncode == 0:
        output = result.stdout.strip()
        if output and output != 'null':
            try:
                data = json.loads(output)
                print(f'✓ Seeded data found:')
                print(f'    ID: {data.get("id")}')
                print(f'    Key: {data.get("key")}')
                print(f'    Value: {data.get("value")}')
            except:
                print(f'✓ Database query successful: {output[:100]}')
        else:
            print('✗ No seeded data found (returned null)')
    else:
        print(f'✗ Database query failed: {result.stderr}')
except Exception as e:
    print(f'✗ Error: {e}')

print('\n' + '=' * 70)
