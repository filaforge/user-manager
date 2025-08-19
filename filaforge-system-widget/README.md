# Filaforge System Widget

A powerful Filament plugin that provides beautiful dashboard widgets for system monitoring and information display.

## Features

- **System Status Widget**: Real-time system health and status overview
- **Resource Usage Widget**: Live CPU, memory, and disk usage monitoring
- **Process List Widget**: Top processes by resource consumption
- **Service Status Widget**: System services health monitoring
- **Network Status Widget**: Network interface and connection status
- **Performance Metrics Widget**: System performance trends and analytics
- **Customizable Display**: Adjustable widget sizes and layouts
- **Auto-refresh**: Configurable refresh intervals for real-time data
- **Responsive Design**: Works seamlessly on all device sizes
- **Dark Mode Support**: Full compatibility with Filament's dark mode

## Installation

### 1. Install via Composer

```bash
composer require filaforge/system-widget
```

### 2. Publish & Migrate

```bash
# Publish provider groups (config, views, migrations)
php artisan vendor:publish --provider="Filaforge\\SystemWidget\\Providers\\SystemWidgetServiceProvider"

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
        ->plugin(\Filaforge\SystemWidget\SystemWidgetPlugin::make());
}
```

## Setup

### Prerequisites

Before using this plugin, ensure your system meets these requirements:

- **Linux/Unix System**: Compatible operating system for system monitoring
- **System Permissions**: Appropriate permissions for system information access
- **Required Extensions**: PHP extensions for system monitoring
- **Storage**: Sufficient storage for widget data and caching

### Configuration

The plugin will automatically:
- Publish configuration files to `config/system-widget.php`
- Publish view files to `resources/views/vendor/system-widget/`
- Publish migration files to `database/migrations/`
- Register necessary routes and middleware

### Widget Configuration

Configure the system widgets in the published config file:

```php
// config/system-widget.php
return [
    'enabled' => env('SYSTEM_WIDGET_ENABLED', true),
    'widgets' => [
        'system_status' => [
            'enabled' => true,
            'refresh_interval' => 30,
            'show_uptime' => true,
            'show_load_average' => true,
            'show_system_info' => true,
        ],
        'resource_usage' => [
            'enabled' => true,
            'refresh_interval' => 15,
            'show_cpu' => true,
            'show_memory' => true,
            'show_disk' => true,
            'show_network' => true,
        ],
        'process_list' => [
            'enabled' => true,
            'refresh_interval' => 60,
            'max_processes' => 10,
            'show_pid' => true,
            'show_user' => true,
            'show_command' => true,
        ],
        'service_status' => [
            'enabled' => true,
            'refresh_interval' => 120,
            'monitored_services' => [
                'nginx', 'apache2', 'mysql', 'redis', 'php-fpm'
            ],
            'show_status' => true,
            'show_uptime' => true,
        ],
    ],
    'display_settings' => [
        'widget_height' => env('SYSTEM_WIDGET_HEIGHT', 'medium'),
        'show_charts' => env('SYSTEM_WIDGET_SHOW_CHARTS', true),
        'chart_type' => env('SYSTEM_WIDGET_CHART_TYPE', 'line'),
        'color_scheme' => env('SYSTEM_WIDGET_COLOR_SCHEME', 'auto'),
    ],
    'performance' => [
        'cache_enabled' => env('SYSTEM_WIDGET_CACHE_ENABLED', true),
        'cache_ttl' => env('SYSTEM_WIDGET_CACHE_TTL', 300),
        'max_data_points' => env('SYSTEM_WIDGET_MAX_DATA_POINTS', 100),
    ],
];
```

### Environment Variables

Add these to your `.env` file:

```env
SYSTEM_WIDGET_ENABLED=true
SYSTEM_WIDGET_HEIGHT=medium
SYSTEM_WIDGET_SHOW_CHARTS=true
SYSTEM_WIDGET_CHART_TYPE=line
SYSTEM_WIDGET_COLOR_SCHEME=auto
SYSTEM_WIDGET_CACHE_ENABLED=true
SYSTEM_WIDGET_CACHE_TTL=300
SYSTEM_WIDGET_MAX_DATA_POINTS=100
```

## Usage

### Accessing System Widgets

1. Navigate to your Filament admin panel
2. The system widgets will automatically appear on your dashboard
3. Configure and customize widgets through the configuration

### Available Widgets

#### System Status Widget
- **System Overview**: OS details, kernel version, architecture
- **Uptime Display**: System uptime and last boot information
- **Load Average**: Current system load average
- **System Health**: Overall system health indicator

#### Resource Usage Widget
- **CPU Usage**: Real-time CPU utilization with charts
- **Memory Usage**: Current memory usage and availability
- **Disk Usage**: Disk space usage and file system information
- **Network Usage**: Network interface statistics and throughput

#### Process List Widget
- **Top Processes**: List of processes by resource usage
- **Process Details**: PID, user, command, and resource consumption
- **Process Management**: Quick process information and status
- **Resource Monitoring**: Monitor specific process resource usage

#### Service Status Widget
- **Service Health**: Monitor system service status
- **Service Uptime**: Track service uptime and availability
- **Service Metrics**: Service performance and health indicators
- **Service Alerts**: Notifications for service issues

#### Network Status Widget
- **Interface Status**: Network interface information and status
- **Connection Monitoring**: Active network connections
- **Traffic Statistics**: Network traffic and bandwidth usage
- **Network Health**: Network connectivity and performance

#### Performance Metrics Widget
- **Historical Data**: Performance trends over time
- **Performance Charts**: Visual representation of system metrics
- **Performance Analysis**: Analyze system performance patterns
- **Capacity Planning**: Use data for capacity planning

### Widget Customization

- **Size Adjustment**: Resize widgets to fit your dashboard layout
- **Refresh Intervals**: Configure how often widgets update
- **Display Options**: Choose what information to display
- **Color Schemes**: Customize widget appearance
- **Chart Types**: Select different chart visualization types

## Troubleshooting

### Common Issues

- **Widgets not showing**: Check if widgets are enabled in configuration
- **Data not updating**: Verify refresh intervals and system permissions
- **Performance issues**: Check cache settings and data point limits
- **Permission errors**: Ensure proper system access permissions

### Debug Steps

1. Check the plugin configuration:
```bash
php artisan config:show system-widget
```

2. Verify routes are registered:
```bash
php artisan route:list | grep system-widget
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
shell_exec('uptime');
shell_exec('free -h');
```

5. Clear caches:
```bash
php artisan optimize:clear
```

6. Check logs for errors:
```bash
tail -f storage/logs/laravel.log
```

### Widget-Specific Issues

#### System Status Widget
- **Uptime not showing**: Check system uptime command availability
- **Load average missing**: Verify load average command access
- **System info errors**: Check system information commands

#### Resource Usage Widget
- **CPU data missing**: Verify CPU monitoring commands
- **Memory data errors**: Check memory monitoring utilities
- **Disk usage issues**: Verify disk space commands

#### Process List Widget
- **Process list empty**: Check process listing permissions
- **High refresh impact**: Adjust refresh intervals for better performance
- **Data accuracy**: Verify process monitoring commands

## Security Considerations

### Access Control

- **Role-based permissions**: Restrict widget access to authorized users only
- **System information**: Limit exposure of sensitive system information
- **User isolation**: Ensure users can only see appropriate system data
- **Audit logging**: Track widget access and usage

### Best Practices

- Never expose system widgets to public users
- Regularly review and update access permissions
- Monitor widget performance and resource usage
- Implement proper user authentication and authorization
- Use HTTPS for secure access
- Regular security audits of widget access

### Data Privacy

- **System information**: Be careful with system details exposure
- **Performance data**: Consider data retention and privacy policies
- **User access**: Limit access to system monitoring data
- **Data encryption**: Consider encrypting sensitive system data

## Performance Optimization

### System Requirements

- **CPU**: Minimal CPU overhead for widget operations
- **Memory**: Adequate RAM for widget data and caching
- **Storage**: Fast storage for widget data and charts
- **Network**: Stable network for real-time updates

### Optimization Tips

- Enable caching for widget data
- Use appropriate refresh intervals
- Limit data points for historical charts
- Monitor widget performance impact
- Implement lazy loading for heavy widgets

### Caching Strategy

- **Data caching**: Cache system information to reduce system calls
- **Chart caching**: Cache chart data for better performance
- **Widget caching**: Cache widget rendering for faster display
- **Cache invalidation**: Proper cache invalidation strategies

## Uninstall

### 1. Remove Plugin Registration

Remove the plugin from your panel provider:
```php
// remove ->plugin(\Filaforge\SystemWidget\SystemWidgetPlugin::make())
```

### 2. Roll Back Migrations (Optional)

```bash
php artisan migrate:rollback
# or roll back specific published files if needed
```

### 3. Remove Published Assets (Optional)

```bash
rm -f config/system-widget.php
rm -rf resources/views/vendor/system-widget
```

### 4. Remove Package and Clear Caches

```bash
composer remove filaforge/system-widget
php artisan optimize:clear
```

### 5. Clean Up Environment Variables

Remove these from your `.env` file:
```env
SYSTEM_WIDGET_ENABLED=true
SYSTEM_WIDGET_HEIGHT=medium
SYSTEM_WIDGET_SHOW_CHARTS=true
SYSTEM_WIDGET_CHART_TYPE=line
SYSTEM_WIDGET_COLOR_SCHEME=auto
SYSTEM_WIDGET_CACHE_ENABLED=true
SYSTEM_WIDGET_CACHE_TTL=300
SYSTEM_WIDGET_MAX_DATA_POINTS=100
```

### 6. Clean Up Widget Data

After uninstalling, consider:
- Removing stored widget data and charts
- Cleaning up any cached widget information
- Removing any custom widget configurations
- Updating dashboard layouts if needed

## Support

- **Documentation**: [GitHub Repository](https://github.com/filaforge/system-widget)
- **Issues**: [GitHub Issues](https://github.com/filaforge/system-widget/issues)
- **Discussions**: [GitHub Discussions](https://github.com/filaforge/system-widget/discussions)

## Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

## License

This plugin is open-sourced software licensed under the [MIT license](LICENSE).

---

**Made with ❤️ by the Filaforge Team**
