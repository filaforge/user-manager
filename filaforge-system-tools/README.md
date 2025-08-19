# Filaforge System Tools

A powerful Filament plugin that provides essential system administration tools directly in your admin panel.

## Features

- **System Information**: Comprehensive system details and specifications
- **Process Management**: View, monitor, and manage system processes
- **Service Control**: Start, stop, and manage system services
- **File Management**: Browse and manage system files and directories
- **Network Tools**: Network configuration and monitoring tools
- **Log Viewer**: View and analyze system logs
- **Performance Monitoring**: Real-time system performance metrics
- **User Management**: System user and group management
- **Backup Tools**: System backup and restore utilities
- **Maintenance Tasks**: System maintenance and optimization tools

## Installation

### 1. Install via Composer

```bash
composer require filaforge/system-tools
```

### 2. Publish & Migrate

```bash
# Publish provider groups (config, views, migrations)
php artisan vendor:publish --provider="Filaforge\\SystemTools\\Providers\\SystemToolsServiceProvider"

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
        ->plugin(\Filaforge\SystemTools\SystemToolsPlugin::make());
}
```

## Setup

### Prerequisites

Before using this plugin, ensure your system meets these requirements:

- **Linux/Unix System**: Compatible operating system
- **System Permissions**: Appropriate permissions for system operations
- **Sudo Access**: Sudo access for administrative operations
- **Required Tools**: Essential system utilities installed

### Configuration

The plugin will automatically:
- Publish configuration files to `config/system-tools.php`
- Publish view files to `resources/views/vendor/system-tools/`
- Publish migration files to `database/migrations/`
- Register necessary routes and middleware

### Tools Configuration

Configure the system tools in the published config file:

```php
// config/system-tools.php
return [
    'enabled' => env('SYSTEM_TOOLS_ENABLED', true),
    'allowed_tools' => [
        'system_info' => true,
        'process_management' => true,
        'service_control' => true,
        'file_management' => true,
        'network_tools' => true,
        'log_viewer' => true,
        'performance_monitoring' => true,
        'user_management' => true,
        'backup_tools' => true,
        'maintenance_tasks' => true,
    ],
    'restricted_directories' => [
        '/etc', '/var/log', '/home', '/root'
    ],
    'allowed_commands' => [
        'ps', 'top', 'htop', 'systemctl', 'service',
        'ls', 'cat', 'tail', 'head', 'grep'
    ],
    'log_retention_days' => env('SYSTEM_TOOLS_LOG_RETENTION', 30),
    'max_processes' => env('SYSTEM_TOOLS_MAX_PROCESSES', 100),
];
```

### Environment Variables

Add these to your `.env` file:

```env
SYSTEM_TOOLS_ENABLED=true
SYSTEM_TOOLS_LOG_RETENTION=30
SYSTEM_TOOLS_MAX_PROCESSES=100
```

## Usage

### Accessing System Tools

1. Navigate to your Filament admin panel
2. Look for the "System Tools" menu item
3. Choose the tool you want to use

### Available Tools

#### System Information
- **System Overview**: OS details, kernel version, architecture
- **Hardware Info**: CPU, memory, disk, network specifications
- **System Status**: Uptime, load average, resource usage

#### Process Management
- **Process List**: View all running processes
- **Process Details**: Detailed process information
- **Process Control**: Start, stop, and manage processes
- **Resource Monitoring**: Monitor process resource usage

#### Service Control
- **Service Status**: Check service status and health
- **Service Control**: Start, stop, restart services
- **Service Configuration**: View and edit service configurations
- **Service Logs**: View service-specific logs

#### File Management
- **File Browser**: Navigate system directories
- **File Operations**: View, edit, copy, move, delete files
- **File Permissions**: Manage file and directory permissions
- **File Search**: Search for files and content

#### Network Tools
- **Network Status**: View network interfaces and status
- **Network Configuration**: Configure network settings
- **Connection Monitoring**: Monitor network connections
- **Network Diagnostics**: Network troubleshooting tools

#### Log Viewer
- **System Logs**: View system and application logs
- **Log Filtering**: Filter logs by date, level, and source
- **Log Search**: Search for specific log entries
- **Log Analysis**: Analyze log patterns and trends

#### Performance Monitoring
- **Real-time Metrics**: Live system performance data
- **Resource Usage**: CPU, memory, disk, network usage
- **Performance Trends**: Historical performance data
- **Alert System**: Performance threshold alerts

#### User Management
- **User List**: View system users and groups
- **User Operations**: Create, modify, delete users
- **Permission Management**: Manage user permissions
- **User Activity**: Monitor user activity and sessions

#### Backup Tools
- **System Backup**: Create system backups
- **Backup Management**: Manage backup schedules and retention
- **Restore Operations**: Restore from backups
- **Backup Verification**: Verify backup integrity

#### Maintenance Tasks
- **System Updates**: Check and apply system updates
- **Package Management**: Manage system packages
- **Cleanup Tasks**: System cleanup and optimization
- **Health Checks**: System health diagnostics

## Troubleshooting

### Common Issues

- **Permission denied**: Ensure the user has appropriate system access
- **Tool not available**: Check if the tool is enabled in configuration
- **Command failures**: Verify system utilities are installed
- **Performance impact**: Monitor tool resource usage

### Debug Steps

1. Check the plugin configuration:
```bash
php artisan config:show system-tools
```

2. Verify routes are registered:
```bash
php artisan route:list | grep system-tools
```

3. Check system permissions:
```bash
# Verify the web server user has system access
sudo -l
whoami
groups
```

4. Test basic system tools:
```bash
# Test if basic commands work
ps aux | head -10
systemctl status
```

5. Clear caches:
```bash
php artisan optimize:clear
```

6. Check logs for errors:
```bash
tail -f storage/logs/laravel.log
```

### Tool-Specific Issues

#### Process Management
- **High process count**: Adjust max_processes setting
- **Permission errors**: Check user permissions for process operations
- **Performance issues**: Optimize process listing and filtering

#### File Management
- **Access denied**: Check directory permissions and restrictions
- **Large directories**: Implement pagination for large directory listings
- **File operations**: Verify file operation permissions

#### Service Control
- **Service not found**: Check if service exists and is accessible
- **Permission denied**: Verify sudo access for service operations
- **Service failures**: Check service logs and dependencies

## Security Considerations

### Access Control

- **Role-based permissions**: Restrict tool access to authorized users only
- **Tool restrictions**: Limit available tools based on user roles
- **Directory restrictions**: Restrict access to sensitive directories
- **Command restrictions**: Whitelist allowed system commands

### Best Practices

- Never expose system tools to public users
- Regularly review and update access permissions
- Monitor tool usage and log suspicious activities
- Implement proper user authentication and authorization
- Use HTTPS for secure access
- Regular security audits of tool access

### System Security

- **File permissions**: Ensure proper file and directory permissions
- **User isolation**: Limit user access to necessary tools only
- **Audit logging**: Track all system tool activities
- **Backup security**: Secure backup files and access

## Performance Optimization

### System Requirements

- **CPU**: Sufficient CPU for tool operations
- **Memory**: Adequate RAM for tool execution
- **Storage**: Fast storage for file operations
- **Network**: Stable network for network tools

### Optimization Tips

- Implement caching for frequently accessed data
- Use pagination for large data sets
- Optimize database queries and operations
- Monitor tool performance and resource usage

## Uninstall

### 1. Remove Plugin Registration

Remove the plugin from your panel provider:
```php
// remove ->plugin(\Filaforge\SystemTools\SystemToolsPlugin::make())
```

### 2. Roll Back Migrations (Optional)

```bash
php artisan migrate:rollback
# or roll back specific published files if needed
```

### 3. Remove Published Assets (Optional)

```bash
rm -f config/system-tools.php
rm -rf resources/views/vendor/system-tools
```

### 4. Remove Package and Clear Caches

```bash
composer remove filaforge/system-tools
php artisan optimize:clear
```

### 5. Clean Up Environment Variables

Remove these from your `.env` file:
```env
SYSTEM_TOOLS_ENABLED=true
SYSTEM_TOOLS_LOG_RETENTION=30
SYSTEM_TOOLS_MAX_PROCESSES=100
```

### 6. Security Cleanup

After uninstalling, consider:
- Reviewing system access permissions
- Cleaning up any custom tool configurations
- Removing any scheduled tasks or cron jobs
- Updating system security settings

## Support

- **Documentation**: [GitHub Repository](https://github.com/filaforge/system-tools)
- **Issues**: [GitHub Issues](https://github.com/filaforge/system-tools/issues)
- **Discussions**: [GitHub Discussions](https://github.com/filaforge/system-tools/discussions)

## Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

## License

This plugin is open-sourced software licensed under the [MIT license](LICENSE).

---

**Made with ❤️ by the Filaforge Team**


