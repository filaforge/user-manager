# Filaforge API Explorer

A powerful Filament plugin for exploring and testing API endpoints directly from your admin panel.

## Features

- **API Endpoint Explorer**: Browse and test all your API routes
- **Request Builder**: Easy-to-use interface for building API requests
- **Response Viewer**: Beautiful display of API responses
- **Authentication Support**: Handle various auth methods
- **Request History**: Keep track of your API testing
- **Export Results**: Save and share your API test results

## Installation

### 1. Install via Composer

```bash
composer require filaforge/api-explorer
```

### 2. Publish & Migrate

```bash
# Publish provider groups (config, views, migrations)
php artisan vendor:publish --provider="Filaforge\\ApiExplorer\\Providers\\ApiExplorerServiceProvider"

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
        ->plugin(\Filaforge\ApiExplorer\ApiExplorerPlugin::make());
}
```

## Setup

### Configuration

The plugin will automatically:
- Publish configuration files to `config/api-explorer.php`
- Publish view files to `resources/views/vendor/api-explorer/`
- Publish migration files to `database/migrations/`
- Register necessary routes and middleware

### Customization

You can customize the plugin behavior by editing the published configuration file:

```php
// config/api-explorer.php
return [
    'route_prefix' => 'api-explorer',
    'middleware' => ['web', 'auth'],
    'max_history' => 100,
];
```

## Usage

### Accessing the API Explorer

1. Navigate to your Filament admin panel
2. Look for the "API Explorer" menu item
3. Start exploring your API endpoints

### Testing API Endpoints

1. **Select Endpoint**: Choose from available API routes
2. **Set Parameters**: Configure request parameters, headers, and body
3. **Send Request**: Execute the API call
4. **View Response**: See the response data, status, and headers
5. **Save Results**: Store successful requests for future reference

### Authentication

The plugin supports various authentication methods:
- Bearer tokens
- API keys
- Session cookies
- Custom headers

## Troubleshooting

### Common Issues

- **Routes not showing**: Ensure your API routes are properly registered
- **Authentication failing**: Check your auth configuration and tokens
- **CORS issues**: Verify your CORS settings for the API endpoints
- **Missing permissions**: Ensure the user has access to the API Explorer

### Debug Steps

1. Check the plugin configuration:
```bash
php artisan config:show api-explorer
```

2. Verify routes are registered:
```bash
php artisan route:list | grep api-explorer
```

3. Clear caches:
```bash
php artisan optimize:clear
```

4. Check logs for errors:
```bash
tail -f storage/logs/laravel.log
```

## Uninstall

### 1. Remove Plugin Registration

Remove the plugin from your panel provider:
```php
// remove ->plugin(\Filaforge\ApiExplorer\ApiExplorerPlugin::make())
```

### 2. Roll Back Migrations (Optional)

```bash
php artisan migrate:rollback
# or roll back specific published files if needed
```

### 3. Remove Published Assets (Optional)

```bash
rm -f config/api-explorer.php
rm -rf resources/views/vendor/api-explorer
```

### 4. Remove Package and Clear Caches

```bash
composer remove filaforge/api-explorer
php artisan optimize:clear
```

## Support

- **Documentation**: [GitHub Repository](https://github.com/filaforge/api-explorer)
- **Issues**: [GitHub Issues](https://github.com/filaforge/api-explorer/issues)
- **Discussions**: [GitHub Discussions](https://github.com/filaforge/api-explorer/discussions)

## Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

## License

This plugin is open-sourced software licensed under the [MIT license](LICENSE).

---

**Made with ❤️ by the Filaforge Team**


