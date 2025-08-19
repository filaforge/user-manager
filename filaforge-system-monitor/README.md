# Filaforge System Monitor

A powerful Filament plugin that provides comprehensive system monitoring and performance metrics directly in your admin panel.

## Features

- **Real-time Monitoring**: Live system performance metrics and status
- **Resource Tracking**: Monitor CPU, memory, disk, and network usage
- **Process Management**: View and manage running processes
- **Service Status**: Monitor system services and their health
- **Performance Metrics**: Track system performance over time
- **Alert System**: Configure notifications for critical thresholds
- **Dashboard Widgets**: Beautiful monitoring widgets for your dashboard
- **Historical Data**: Store and analyze performance trends
- **Multi-server Support**: Monitor multiple servers from one interface
- **Custom Metrics**: Add custom monitoring metrics and alerts

## Installation

### 1. Install via Composer

```bash
composer require filaforge/system-monitor
```

### 2. Publish & Migrate

```bash
# Publish provider groups (config, views, migrations)
php artisan vendor:publish --provider="Filaforge\\SystemMonitor\\Providers\\SystemMonitorServiceProvider"

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
        ->plugin(\Filaforge\SystemMonitor\SystemMonitorPlugin::make());
}
```

## Setup

### Prerequisites

Before using this plugin, ensure your system meets these requirements:

- **PHP Extensions**: Required extensions for system monitoring
- **System Permissions**: Appropriate permissions for system access
- **Storage**: Sufficient storage for metrics and logs

### Configuration

The plugin will automatically:
- Publish configuration files to `config/system-monitor.php`
- Publish view files to `resources/views/vendor/system-monitor/`
- Publish migration files to `database/migrations/`
- Register necessary routes and middleware

### Monitor Configuration

Configure the system monitor in the published config file:

```php
// config/system-monitor.php
return [
    'enabled' => env('SYSTEM_MONITOR_ENABLED', true),
    'update_interval' => env('SYSTEM_MONITOR_UPDATE_INTERVAL', 30),
    'retention_days' => env('SYSTEM_MONITOR_RETENTION_DAYS', 30),
    'metrics' => [
        'cpu' => true,
        'memory' => true,
        'disk' => true,
        'network' => true,
        'processes' => true,
        'services' => true,
    ],
    'alerts' => [
        'cpu_threshold' => env('SYSTEM_MONITOR_CPU_THRESHOLD', 80),
        'memory_threshold' => env('SYSTEM_MONITOR_MEMORY_THRESHOLD', 85),
        'disk_threshold' => env('SYSTEM_MONITOR_DISK_THRESHOLD', 90),
    ],
    'dashboard_widgets' => [
        'system_status' => true,
        'resource_usage' => true,
        'process_list' => true,
        'service_status' => true,
    ],
];
```

### Environment Variables

Add these to your `.env` file:

```env
SYSTEM_MONITOR_ENABLED=true
SYSTEM_MONITOR_UPDATE_INTERVAL=30
SYSTEM_MONITOR_RETENTION_DAYS=30
SYSTEM_MONITOR_CPU_THRESHOLD=80
SYSTEM_MONITOR_MEMORY_THRESHOLD=85
SYSTEM_MONITOR_DISK_THRESHOLD=90
```

## Usage

### Accessing the System Monitor

1. Navigate to your Filament admin panel
2. Look for the "System Monitor" menu item
3. View system metrics and performance data

### Dashboard Widgets

The plugin provides several dashboard widgets:

- **System Status**: Overall system health and status
- **Resource Usage**: Real-time CPU, memory, and disk usage
- **Process List**: Top processes by resource usage
- **Service Status**: System services and their status

### Monitoring Features

1. **System Overview**: Get a quick overview of system health
2. **Resource Monitoring**: Track CPU, memory, disk, and network usage
3. **Process Management**: View and manage running processes
4. **Service Monitoring**: Monitor system services and their health
5. **Performance Trends**: Analyze performance over time
6. **Alert Configuration**: Set up alerts for critical thresholds

### Advanced Features

- **Custom Metrics**: Add custom monitoring metrics
- **Multi-server Monitoring**: Monitor multiple servers
- **Performance Analysis**: Analyze performance trends and patterns
- **Capacity Planning**: Use historical data for capacity planning

## Troubleshooting

### Common Issues

- **Permission denied**: Ensure the user has appropriate system access
- **Metrics not updating**: Check update interval and cron jobs
- **High resource usage**: Monitor the monitor itself for performance impact
- **Missing data**: Verify data retention settings and storage

### Debug Steps

1. Check the plugin configuration:
```bash
php artisan config:show system-monitor
```

2. Verify routes are registered:
```bash
php artisan route:list | grep system-monitor
```

3. Check system permissions:
```bash
# Verify the web server user has system access
whoami
groups
```

4. Test system monitoring:
```bash
# Test if basic system commands work
php artisan tinker
shell_exec('top -bn1 | head -20');
```

5. Clear caches:
```bash
php artisan optimize:clear
```

6. Check logs for errors:
```bash
tail -f storage/logs/laravel.log
```

### Performance Optimization

- **Update intervals**: Adjust monitoring frequency based on needs
- **Data retention**: Configure appropriate data retention periods
- **Resource usage**: Monitor the monitoring system itself
- **Caching**: Implement caching for frequently accessed metrics

## Security Considerations

### Access Control

- **Role-based permissions**: Restrict monitor access to authorized users only
- **System access**: Limit system access to necessary monitoring functions
- **Data privacy**: Ensure sensitive system information is protected
- **Audit logging**: Track all monitoring activities

### Best Practices

- Never expose system monitoring to public users
- Regularly review and update access permissions
- Monitor the monitoring system for security issues
- Implement proper user authentication and authorization
- Use HTTPS for secure access
- Regular security audits of monitoring access

## Performance Optimization

### System Requirements

- **CPU**: Minimal CPU overhead for monitoring
- **Memory**: Sufficient RAM for metrics storage
- **Storage**: Fast storage for metrics and logs
- **Network**: Stable network for multi-server monitoring

### Optimization Tips

- Use appropriate update intervals
- Implement data retention policies
- Monitor monitoring system performance
- Use caching for frequently accessed data

## Uninstall

### 1. Remove Plugin Registration

Remove the plugin from your panel provider:
```php
// remove ->plugin(\Filaforge\SystemMonitor\SystemMonitorPlugin::make())
```

### 2. Roll Back Migrations (Optional)

```bash
php artisan migrate:rollback
# or roll back specific published files if needed
```

### 3. Remove Published Assets (Optional)

```bash
rm -f config/system-monitor.php
rm -rf resources/views/vendor/system-monitor
```

### 4. Remove Package and Clear Caches

```bash
composer remove filaforge/system-monitor
php artisan optimize:clear
```

### 5. Clean Up Environment Variables

Remove these from your `.env` file:
```env
SYSTEM_MONITOR_ENABLED=true
SYSTEM_MONITOR_UPDATE_INTERVAL=30
SYSTEM_MONITOR_RETENTION_DAYS=30
SYSTEM_MONITOR_CPU_THRESHOLD=80
SYSTEM_MONITOR_MEMORY_THRESHOLD=85
SYSTEM_MONITOR_DISK_THRESHOLD=90
```

### 6. Clean Up Monitoring Data

After uninstalling, consider:
- Removing stored metrics and logs
- Cleaning up any cron jobs or scheduled tasks
- Removing any custom monitoring configurations
- Updating system access permissions

## Support

- **Documentation**: [GitHub Repository](https://github.com/filaforge/system-monitor)
- **Issues**: [GitHub Issues](https://github.com/filaforge/system-monitor/issues)
- **Discussions**: [GitHub Discussions](https://github.com/filaforge/system-monitor/discussions)

## Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

## License

This plugin is open-sourced software licensed under the [MIT license](LICENSE).

---

**Made with ❤️ by the Filaforge Team**
