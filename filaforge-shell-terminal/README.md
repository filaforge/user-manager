# Filaforge Shell Terminal

A powerful Filament plugin that provides a secure web-based terminal interface directly in your admin panel.

## Features

- **Web-based Terminal**: Full terminal experience in your browser
- **Enhanced Security**: Comprehensive command filtering and rate limiting
- **Smart Input**: Tab completion, command history, and keyboard shortcuts
- **Modern UI**: Responsive design with dark/light mode support
- **Preset Commands**: Quick access to common Laravel and system commands
- **Command Logging**: Optional audit trail for security compliance
- **Session Management**: Persistent terminal sessions
- **Multi-user Support**: Separate terminal sessions for each user
- **Audit Logging**: Track all terminal activities for security

## Installation

### 1. Install via Composer

```bash
composer require filaforge/shell-terminal
```

### 2. Publish & Migrate

```bash
# Publish provider groups (config, views, migrations)
php artisan vendor:publish --provider="Filaforge\\ShellTerminal\\Providers\\ShellTerminalServiceProvider"

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
        ->plugin(\Filaforge\ShellTerminal\ShellTerminalPlugin::make());
}
```

## Setup

### Prerequisites

Before using this plugin, ensure your system meets these requirements:

- **PHP**: 8.1 or higher
- **Laravel**: 12.x
- **Filament**: 4.x (Panel Builder)
- **Node.js**: 16+ (for asset building)

### Configuration

The plugin will automatically:
- Publish configuration files to `config/shell-terminal.php`
- Publish view files to `resources/views/vendor/shell-terminal/`
- Publish migration files to `database/migrations/`
- Register necessary routes and middleware

### Terminal Configuration

Configure the shell terminal in the published config file:

```php
// config/shell-terminal.php
return [
    'enabled' => env('SHELL_TERMINAL_ENABLED', true),
    'rate_limit' => env('SHELL_TERMINAL_RATE_LIMIT', 60),
    'command_timeout' => env('SHELL_TERMINAL_TIMEOUT', 300),
    'max_history' => env('SHELL_TERMINAL_MAX_HISTORY', 100),
    'log_commands' => env('SHELL_TERMINAL_LOG_COMMANDS', false),
    'require_confirmation' => env('SHELL_TERMINAL_REQUIRE_CONFIRMATION', true),
    'show_welcome_message' => env('SHELL_TERMINAL_SHOW_WELCOME', true),
    'enable_tab_completion' => env('SHELL_TERMINAL_TAB_COMPLETION', true),
    'enable_command_history' => env('SHELL_TERMINAL_HISTORY', true),
    'terminal_height' => env('SHELL_TERMINAL_HEIGHT', 60),
    'dark_mode' => env('SHELL_TERMINAL_DARK_MODE', true),
];
```

### Environment Variables

Add these to your `.env` file:

```env
SHELL_TERMINAL_ENABLED=true
SHELL_TERMINAL_RATE_LIMIT=60
SHELL_TERMINAL_TIMEOUT=300
SHELL_TERMINAL_MAX_HISTORY=100
SHELL_TERMINAL_LOG_COMMANDS=false
SHELL_TERMINAL_REQUIRE_CONFIRMATION=true
SHELL_TERMINAL_SHOW_WELCOME=true
SHELL_TERMINAL_TAB_COMPLETION=true
SHELL_TERMINAL_HISTORY=true
SHELL_TERMINAL_HEIGHT=60
SHELL_TERMINAL_DARK_MODE=true
```

## Usage

### Accessing the Shell Terminal

1. Navigate to your Filament admin panel
2. Look for the "Shell Terminal" menu item
3. Open a new terminal session

### Basic Terminal Operations

1. **Command Execution**: Type commands and press Enter
2. **File Navigation**: Use `cd`, `ls`, `pwd` for file operations
3. **File Management**: Create, edit, and delete files
4. **Process Control**: Monitor and manage system processes
5. **System Information**: Get system status and information

### Preset Commands

The plugin includes categorized preset commands:

- **Laravel**: Artisan commands, migrations, testing
- **Composer**: Package management
- **Git**: Version control operations
- **System**: File operations, monitoring
- **Database**: Database management
- **Optimization**: Performance tuning
- **Maintenance**: System maintenance

### Advanced Features

- **Tab Completion**: Use Tab key for command and file completion
- **Command History**: Access previous commands with arrow keys
- **Session Persistence**: Terminal sessions persist across page refreshes
- **Multi-tab Support**: Open multiple terminal tabs
- **Custom Aliases**: Create and use command aliases

## Troubleshooting

### Common Issues

- **Permission denied**: Ensure the user has appropriate shell access
- **Command not found**: Check if the command is in the allowed list
- **Session timeout**: Increase session timeout in configuration
- **Performance issues**: Check system resources and command complexity

### Debug Steps

1. Check the plugin configuration:
```bash
php artisan config:show shell-terminal
```

2. Verify routes are registered:
```bash
php artisan route:list | grep shell-terminal
```

3. Check user permissions:
```bash
# Verify the web server user has shell access
whoami
groups
```

4. Test basic shell functionality:
```bash
# Test if basic commands work
php artisan tinker
shell_exec('pwd');
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

- **Command caching**: Cache frequently used command results
- **Session management**: Optimize terminal session handling
- **Resource monitoring**: Monitor system resources during terminal use
- **Command queuing**: Implement command queuing for heavy operations

## Security Considerations

### Access Control

- **Role-based permissions**: Restrict terminal access to authorized users only
- **Command restrictions**: Whitelist allowed commands and block dangerous ones
- **User isolation**: Ensure users can only access their own terminal sessions
- **Audit logging**: Track all terminal activities and commands

### Security Features

- **Command Filtering**: Built-in protection against dangerous commands
- **Pattern Matching**: Blocks shell piping and other risky patterns
- **Directory Restrictions**: Limits command execution to safe directories
- **Rate Limiting**: Configurable commands per minute with abuse prevention

### Best Practices

- Never expose the terminal to public users
- Regularly review and update command whitelists
- Monitor terminal usage and log suspicious activities
- Implement proper user authentication and authorization
- Use HTTPS for secure terminal access
- Regular security audits of terminal usage

## Performance Optimization

### System Requirements

- **CPU**: Multi-core processor for better performance
- **Memory**: Sufficient RAM for terminal sessions
- **Storage**: Fast storage for command execution
- **Network**: Stable network for web terminal access

### Optimization Tips

- Use command caching for repeated operations
- Implement session pooling for multiple users
- Monitor system resources during peak usage
- Optimize command execution timeouts

## Uninstall

### 1. Remove Plugin Registration

Remove the plugin from your panel provider:
```php
// remove ->plugin(\Filaforge\ShellTerminal\ShellTerminalPlugin::make())
```

### 2. Roll Back Migrations (Optional)

```bash
php artisan migrate:rollback
# or roll back specific published files if needed
```

### 3. Remove Published Assets (Optional)

```bash
rm -f config/shell-terminal.php
rm -rf resources/views/vendor/shell-terminal
```

### 4. Remove Package and Clear Caches

```bash
composer remove filaforge/shell-terminal
php artisan optimize:clear
```

### 5. Clean Up Environment Variables

Remove these from your `.env` file:
```env
SHELL_TERMINAL_ENABLED=true
SHELL_TERMINAL_RATE_LIMIT=60
SHELL_TERMINAL_TIMEOUT=300
SHELL_TERMINAL_MAX_HISTORY=100
SHELL_TERMINAL_LOG_COMMANDS=false
SHELL_TERMINAL_REQUIRE_CONFIRMATION=true
SHELL_TERMINAL_SHOW_WELCOME=true
SHELL_TERMINAL_TAB_COMPLETION=true
SHELL_TERMINAL_HISTORY=true
SHELL_TERMINAL_HEIGHT=60
SHELL_TERMINAL_DARK_MODE=true
```

### 6. Security Cleanup

After uninstalling, consider:
- Reviewing system logs for any suspicious activities
- Updating firewall rules if terminal-specific rules were added
- Removing any custom shell configurations
- Updating user permissions and access controls

## Support

- **Documentation**: [GitHub Repository](https://github.com/filaforge/shell-terminal)
- **Issues**: [GitHub Issues](https://github.com/filaforge/shell-terminal/issues)
- **Discussions**: [GitHub Discussions](https://github.com/filaforge/shell-terminal/discussions)

## Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

## License

This plugin is open-sourced software licensed under the [MIT license](LICENSE).

---

**Made with ❤️ by the Filaforge Team**
