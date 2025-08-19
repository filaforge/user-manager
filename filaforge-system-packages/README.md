# Filaforge System Packages

A powerful Filament plugin that provides comprehensive system package management directly in your admin panel.

## Features

- **Package Management**: View, install, update, and remove system packages
- **Repository Management**: Manage package repositories and sources
- **Dependency Tracking**: Track package dependencies and conflicts
- **Update Management**: Monitor and apply system updates
- **Security Updates**: Prioritize and apply security patches
- **Package Search**: Search for available packages
- **Installation History**: Track package installation and removal
- **System Health**: Monitor system package health and status
- **Multi-distribution Support**: Support for various Linux distributions
- **Automated Updates**: Schedule and automate package updates

## Installation

### 1. Install via Composer

```bash
composer require filaforge/system-packages
```

### 2. Publish & Migrate

```bash
# Publish provider groups (config, views, migrations)
php artisan vendor:publish --provider="Filaforge\\SystemPackages\\Providers\\SystemPackagesServiceProvider"

# Run migrations
php artisan migrate
```

### 3. Register Plugin

Add the plugin to your Filament panel provider:

```php
use Filament\Panel;

public function panel(Panel $panel): Panel
{
    return $panel
        // ... other configuration
        ->plugin(\Filaforge\SystemPackages\SystemPackagesPlugin::make());
}
```

## Setup

### Prerequisites

Before using this plugin, ensure your system meets these requirements:

- **Linux Distribution**: Compatible Linux distribution (Ubuntu, CentOS, etc.)
- **Package Manager**: Supported package manager (apt, yum, dnf, etc.)
- **System Permissions**: Appropriate permissions for package management
- **Sudo Access**: Sudo access for package operations

### Configuration

The plugin will automatically:
- Publish configuration files to `config/system-packages.php`
- Publish view files to `resources/views/vendor/system-packages/`
- Publish migration files to `database/migrations/`
- Register necessary routes and middleware

### Package Manager Configuration

Configure the system packages in the published config file:

```php
// config/system-packages.php
return [
    'enabled' => env('SYSTEM_PACKAGES_ENABLED', true),
    'package_manager' => env('SYSTEM_PACKAGES_MANAGER', 'auto'),
    'update_check_interval' => env('SYSTEM_PACKAGES_UPDATE_INTERVAL', 3600),
    'auto_update' => env('SYSTEM_PACKAGES_AUTO_UPDATE', false),
    'security_updates_only' => env('SYSTEM_PACKAGES_SECURITY_ONLY', true),
    'allowed_packages' => [
        'nginx', 'apache2', 'mysql-server', 'php', 'composer',
        'git', 'nodejs', 'npm', 'docker', 'redis-server'
    ],
    'blocked_packages' => [
        'unattended-upgrades', 'snapd', 'flatpak'
    ],
    'repositories' => [
        'main' => true,
        'universe' => true,
        'multiverse' => false,
        'restricted' => false,
    ],
];
```

### Environment Variables

Add these to your `.env` file:

```env
SYSTEM_PACKAGES_ENABLED=true
SYSTEM_PACKAGES_MANAGER=auto
SYSTEM_PACKAGES_UPDATE_INTERVAL=3600
SYSTEM_PACKAGES_AUTO_UPDATE=false
SYSTEM_PACKAGES_SECURITY_ONLY=true
```

## Usage

### Accessing System Packages

1. Navigate to your Filament admin panel
2. Look for the "System Packages" menu item
3. Manage system packages and updates

### Package Management

1. **View Packages**: Browse installed and available packages
2. **Install Packages**: Install new packages from repositories
3. **Update Packages**: Update existing packages to latest versions
4. **Remove Packages**: Remove unwanted packages
5. **Search Packages**: Search for specific packages

### Update Management

1. **Check Updates**: Check for available package updates
2. **Security Updates**: Prioritize security-related updates
3. **Update All**: Update all available packages
4. **Update Specific**: Update specific packages only
5. **Rollback**: Rollback to previous package versions

### Repository Management

1. **View Repositories**: List configured package repositories
2. **Add Repositories**: Add new package repositories
3. **Enable/Disable**: Enable or disable specific repositories
4. **Repository Health**: Check repository health and status

## Troubleshooting

### Common Issues

- **Permission denied**: Ensure the user has sudo access for package operations
- **Package manager not found**: Check if supported package manager is installed
- **Repository errors**: Verify repository configuration and connectivity
- **Update failures**: Check system resources and package conflicts

### Debug Steps

1. Check the plugin configuration:
```bash
php artisan config:show system-packages
```

2. Verify routes are registered:
```bash
php artisan route:list | grep system-packages
```

3. Check system permissions:
```bash
# Verify the web server user has sudo access
sudo -l
whoami
```

4. Test package manager:
```bash
# Test if package manager works
sudo apt update
# or
sudo yum update
```

5. Clear caches:
```bash
php artisan optimize:clear
```

6. Check logs for errors:
```bash
tail -f storage/logs/laravel.log
```

### Package Manager Issues

#### APT (Ubuntu/Debian)
- **Lock file errors**: Remove lock files and retry
- **Repository issues**: Check `/etc/apt/sources.list`
- **GPG key errors**: Update package signing keys

#### YUM/DNF (CentOS/RHEL)
- **Repository errors**: Check `/etc/yum.repos.d/`
- **GPG key issues**: Import missing GPG keys
- **Cache corruption**: Clear yum cache

## Security Considerations

### Access Control

- **Role-based permissions**: Restrict package management to authorized users only
- **Sudo access**: Limit sudo access to package management commands only
- **Package restrictions**: Whitelist allowed packages and block dangerous ones
- **Audit logging**: Track all package management activities

### Best Practices

- Never expose package management to public users
- Regularly review and update package lists
- Monitor package installations and removals
- Implement proper user authentication and authorization
- Use HTTPS for secure repository access
- Regular security audits of package management

### Package Security

- **Source verification**: Verify package sources and signatures
- **Update policies**: Implement security-first update policies
- **Vulnerability scanning**: Scan for known package vulnerabilities
- **Backup strategies**: Backup system before major updates

## Performance Optimization

### System Requirements

- **CPU**: Sufficient CPU for package operations
- **Memory**: Adequate RAM for package management
- **Storage**: Fast storage for package downloads and installation
- **Network**: Stable network for repository access

### Optimization Tips

- Use local package mirrors when possible
- Implement package caching strategies
- Schedule updates during low-traffic periods
- Monitor system resources during operations

## Uninstall

### 1. Remove Plugin Registration

Remove the plugin from your panel provider:
```php
// remove ->plugin(\Filaforge\SystemPackages\SystemPackagesPlugin::make())
```

### 2. Roll Back Migrations (Optional)

```bash
php artisan migrate:rollback
# or roll back specific published files if needed
```

### 3. Remove Published Assets (Optional)

```bash
rm -f config/system-packages.php
rm -rf resources/views/vendor/system-packages
```

### 4. Remove Package and Clear Caches

```bash
composer remove filaforge/system-packages
php artisan optimize:clear
```

### 5. Clean Up Environment Variables

Remove these from your `.env` file:
```env
SYSTEM_PACKAGES_ENABLED=true
SYSTEM_PACKAGES_MANAGER=auto
SYSTEM_PACKAGES_UPDATE_INTERVAL=3600
SYSTEM_PACKAGES_AUTO_UPDATE=false
SYSTEM_PACKAGES_SECURITY_ONLY=true
```

### 6. Security Cleanup

After uninstalling, consider:
- Reviewing sudo access and removing package management permissions
- Cleaning up any custom package configurations
- Reviewing installed packages for security
- Updating system access controls

## Support

- **Documentation**: [GitHub Repository](https://github.com/filaforge/system-packages)
- **Issues**: [GitHub Issues](https://github.com/filaforge/system-packages/issues)
- **Discussions**: [GitHub Discussions](https://github.com/filaforge/system-packages/discussions)

## Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

## License

This plugin is open-sourced software licensed under the [MIT license](LICENSE).

---

**Made with ❤️ by the Filaforge Team**
