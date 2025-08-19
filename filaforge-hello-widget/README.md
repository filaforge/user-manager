# Filaforge Hello Widget

A simple and elegant Filament plugin that adds a customizable hello widget to your admin panel dashboard.

## Features

- **Dashboard Widget**: Beautiful hello widget for your Filament dashboard
- **Customizable Greeting**: Personalize the welcome message
- **User Information**: Display current user details and status
- **Responsive Design**: Works seamlessly on all device sizes
- **Dark Mode Support**: Full compatibility with Filament's dark mode
- **Easy Customization**: Simple configuration options
- **Performance Optimized**: Lightweight and fast loading
- **Accessibility**: Built with accessibility best practices

## Installation

### 1. Install via Composer

```bash
composer require filaforge/hello-widget
```

### 2. Publish & Migrate

```bash
# Publish provider groups (config, views, migrations)
php artisan vendor:publish --provider="Filaforge\\HelloWidget\\Providers\\HelloWidgetServiceProvider"

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
        ->plugin(\Filaforge\HelloWidget\HelloWidgetPlugin::make());
}
```

## Setup

### Configuration

The plugin will automatically:
- Publish configuration files to `config/hello-widget.php`
- Publish view files to `resources/views/vendor/hello-widget/`
- Publish migration files to `database/migrations/`
- Register necessary routes and middleware

### Widget Configuration

Configure the hello widget in the published config file:

```php
// config/hello-widget.php
return [
    'greeting' => 'Hello',
    'show_user_info' => true,
    'show_timestamp' => true,
    'custom_message' => 'Welcome to your dashboard!',
    'widget_position' => 'top',
    'refresh_interval' => 0, // 0 = no auto-refresh
    'allowed_roles' => [], // Empty = all authenticated users
];
```

### Environment Variables

Add these to your `.env` file if needed:

```env
HELLO_WIDGET_GREETING=Hello
HELLO_WIDGET_CUSTOM_MESSAGE=Welcome to your dashboard!
HELLO_WIDGET_SHOW_USER_INFO=true
```

## Usage

### Accessing the Hello Widget

1. Navigate to your Filament admin panel
2. The hello widget will appear on your dashboard
3. Customize the widget through the configuration

### Widget Features

1. **Greeting Display**: Shows a personalized greeting message
2. **User Information**: Displays current user name and details
3. **Timestamp**: Shows current date and time
4. **Custom Messages**: Display custom welcome messages
5. **Responsive Layout**: Adapts to different screen sizes

### Customization Options

- **Greeting Text**: Change the default greeting message
- **User Info Display**: Toggle user information visibility
- **Timestamp Format**: Customize date and time display
- **Widget Position**: Control where the widget appears
- **Auto-refresh**: Set automatic refresh intervals
- **Role Restrictions**: Limit widget access to specific user roles

## Troubleshooting

### Common Issues

- **Widget not showing**: Ensure the plugin is properly registered
- **Configuration not loading**: Check if config file is published
- **User info missing**: Verify user authentication is working
- **Styling issues**: Clear view caches and check CSS conflicts

### Debug Steps

1. Check the plugin configuration:
```bash
php artisan config:show hello-widget
```

2. Verify routes are registered:
```bash
php artisan route:list | grep hello-widget
```

3. Check if widget is registered:
```bash
php artisan tinker
# Check widget registration
```

4. Clear caches:
```bash
php artisan optimize:clear
php artisan view:clear
```

5. Check logs for errors:
```bash
tail -f storage/logs/laravel.log
```

### Widget Customization

If you need to customize the widget appearance:

1. Publish the widget views:
```bash
php artisan vendor:publish --tag=hello-widget-views
```

2. Edit the published views in `resources/views/vendor/hello-widget/`

3. Customize the CSS in `resources/css/hello-widget.css`

## Security Considerations

### Access Control

- **Role-based permissions**: Restrict widget access to authorized users
- **User data privacy**: Ensure sensitive user information is not exposed
- **Widget visibility**: Control who can see the widget content

### Best Practices

- Use appropriate user role restrictions
- Avoid displaying sensitive information in the widget
- Implement proper user authentication
- Regularly review access permissions

## Uninstall

### 1. Remove Plugin Registration

Remove the plugin from your panel provider:
```php
// remove ->plugin(\Filaforge\HelloWidget\HelloWidgetPlugin::make())
```

### 2. Roll Back Migrations (Optional)

```bash
php artisan migrate:rollback
# or roll back specific published files if needed
```

### 3. Remove Published Assets (Optional)

```bash
rm -f config/hello-widget.php
rm -rf resources/views/vendor/hello-widget
```

### 4. Remove Package and Clear Caches

```bash
composer remove filaforge/hello-widget
php artisan optimize:clear
```

### 5. Clean Up Environment Variables

Remove these from your `.env` file:
```env
HELLO_WIDGET_GREETING=Hello
HELLO_WIDGET_CUSTOM_MESSAGE=Welcome to your dashboard!
HELLO_WIDGET_SHOW_USER_INFO=true
```

## Support

- **Documentation**: [GitHub Repository](https://github.com/filaforge/hello-widget)
- **Issues**: [GitHub Issues](https://github.com/filaforge/hello-widget/issues)
- **Discussions**: [GitHub Discussions](https://github.com/filaforge/hello-widget/discussions)

## Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

## License

This plugin is open-sourced software licensed under the [MIT license](LICENSE).

---

**Made with ❤️ by the Filaforge Team**
