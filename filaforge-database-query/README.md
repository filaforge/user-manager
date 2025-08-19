# Filaforge Database Query

A powerful Filament plugin that provides a SQL query interface directly in your admin panel for database management and analysis.

## Features

- **SQL Query Interface**: Write and execute SQL queries directly in Filament
- **Query Builder**: Visual query builder for complex database operations
- **Result Export**: Export query results in multiple formats (CSV, JSON, Excel)
- **Query History**: Save and reuse frequently used queries
- **Schema Explorer**: Browse database structure and relationships
- **Query Validation**: Built-in SQL syntax checking and validation
- **Security**: Role-based access control for database operations
- **Performance Monitoring**: Track query execution times and performance

## Installation

### 1. Install via Composer

```bash
composer require filaforge/database-query
```

### 2. Publish & Migrate

```bash
# Publish provider groups (config, views, migrations)
php artisan vendor:publish --provider="Filaforge\\DatabaseQuery\\Providers\\DatabaseQueryServiceProvider"

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
        ->plugin(\Filaforge\DatabaseQuery\DatabaseQueryPlugin::make());
}
```

## Setup

### Configuration

The plugin will automatically:
- Publish configuration files to `config/database-query.php`
- Publish view files to `resources/views/vendor/database-query/`
- Publish migration files to `database/migrations/`
- Register necessary routes and middleware

### Database Configuration

Configure database access in the published config file:

```php
// config/database-query.php
return [
    'allowed_databases' => ['mysql', 'pgsql', 'sqlite'],
    'max_query_time' => 300, // 5 minutes
    'max_results' => 10000,
    'allowed_operations' => ['SELECT', 'SHOW', 'DESCRIBE'],
    'admin_only' => false,
];
```

### Environment Variables

Add these to your `.env` file if needed:

```env
DB_QUERY_ENABLED=true
DB_QUERY_MAX_TIME=300
DB_QUERY_MAX_ROWS=10000
```

## Usage

### Accessing the Database Query Tool

1. Navigate to your Filament admin panel
2. Look for the "Database Query" menu item
3. Start writing and executing SQL queries

### Writing Queries

1. **Select Database**: Choose the target database connection
2. **Write SQL**: Enter your SQL query in the editor
3. **Validate**: Check syntax before execution
4. **Execute**: Run the query and view results
5. **Export**: Download results in your preferred format

### Query Examples

```sql
-- Basic SELECT query
SELECT * FROM users WHERE created_at >= '2024-01-01';

-- Complex JOIN query
SELECT u.name, p.title, c.body 
FROM users u 
JOIN posts p ON u.id = p.user_id 
JOIN comments c ON p.id = c.post_id 
WHERE u.active = 1;

-- Database schema exploration
SHOW TABLES;
DESCRIBE users;
```

### Advanced Features

- **Query Templates**: Save and reuse common queries
- **Parameter Binding**: Use prepared statements for security
- **Result Filtering**: Filter and sort query results
- **Query Optimization**: Get suggestions for improving query performance

## Troubleshooting

### Common Issues

- **Permission denied**: Ensure the user has database access rights
- **Query timeout**: Check the max_query_time configuration
- **Memory limits**: Large result sets may exceed PHP memory limits
- **Connection issues**: Verify database connection settings

### Debug Steps

1. Check the plugin configuration:
```bash
php artisan config:show database-query
```

2. Verify routes are registered:
```bash
php artisan route:list | grep database-query
```

3. Test database connectivity:
```bash
php artisan tinker
# Test database connection manually
```

4. Clear caches:
```bash
php artisan optimize:clear
```

5. Check logs for errors:
```bash
tail -f storage/logs/laravel.log
```

### Performance Tips

- Use `LIMIT` clauses for large datasets
- Add proper indexes to frequently queried columns
- Avoid `SELECT *` in production queries
- Use prepared statements for repeated queries

## Security Considerations

### Access Control

- **Role-based permissions**: Restrict access to authorized users only
- **Query validation**: Whitelist allowed SQL operations
- **Result limits**: Prevent excessive data exposure
- **Audit logging**: Track all database operations

### Best Practices

- Never allow `DROP`, `DELETE`, or `UPDATE` operations without proper safeguards
- Use read-only database users when possible
- Implement query timeout limits
- Monitor and log all database activities

## Uninstall

### 1. Remove Plugin Registration

Remove the plugin from your panel provider:
```php
// remove ->plugin(\Filaforge\DatabaseQuery\DatabaseQueryPlugin::make())
```

### 2. Roll Back Migrations (Optional)

```bash
php artisan migrate:rollback
# or roll back specific published files if needed
```

### 3. Remove Published Assets (Optional)

```bash
rm -f config/database-query.php
rm -rf resources/views/vendor/database-query
```

### 4. Remove Package and Clear Caches

```bash
composer remove filaforge/database-query
php artisan optimize:clear
```

## Support

- **Documentation**: [GitHub Repository](https://github.com/filaforge/database-query)
- **Issues**: [GitHub Issues](https://github.com/filaforge/database-query/issues)
- **Discussions**: [GitHub Discussions](https://github.com/filaforge/database-query/discussions)

## Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

## License

This plugin is open-sourced software licensed under the [MIT license](LICENSE).

---

**Made with ❤️ by the Filaforge Team**


