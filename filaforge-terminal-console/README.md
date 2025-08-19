# Filaforge Terminal Console

A powerful Filament plugin that provides a web-based terminal console directly in your admin panel for command execution and system management.

## Features

- **Web-based Terminal**: Full terminal experience in your browser
- **Command Execution**: Run system commands and scripts
- **File Management**: Navigate and manage files through terminal commands
- **Process Control**: Monitor and manage system processes
- **Real-time Output**: Live command execution and response display
- **Command History**: Track and reuse executed commands
- **Session Management**: Persistent terminal sessions
- **Multi-user Support**: Separate terminal sessions for each user
- **Security Controls**: Role-based access and command restrictions
- **Audit Logging**: Track all terminal activities for security

## Installation

### 1. Install via Composer

```bash
composer require filaforge/terminal-console
```

### 2. Publish & Migrate

```bash
# Publish provider groups (config, views, migrations)
php artisan vendor:publish --provider="Filaforge\\TerminalConsole\\Providers\\TerminalConsoleServiceProvider"

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
        ->plugin(\Filaforge\TerminalConsole\TerminalConsolePlugin::make());
}
```

## Setup

### Prerequisites

Before using this plugin, ensure your system meets these requirements:

- **Linux/Unix System**: Compatible operating system for terminal operations
- **System Permissions**: Appropriate permissions for command execution
- **Sudo Access**: Sudo access for administrative operations
- **Required Tools**: Essential system utilities installed

### Configuration

The plugin will automatically:
- Publish configuration files to `config/terminal-console.php`
- Publish view files to `resources/views/vendor/terminal-console/`
- Publish migration files to `database/migrations/`
- Register necessary routes and middleware

### Terminal Configuration

Configure the terminal console in the published config file:

```php
// config/terminal-console.php
return [
    'enabled' => env('TERMINAL_CONSOLE_ENABLED', true),
    'allowed_commands' => [
        'ls', 'cd', 'pwd', 'cat', 'grep', 'find',
        'ps', 'top', 'htop', 'df', 'du', 'mkdir',
        'rm', 'cp', 'mv', 'chmod', 'chown', 'tar',
        'gzip', 'unzip', 'wget', 'curl', 'git'
    ],
    'blocked_commands' => [
        'rm -rf /', 'dd', 'mkfs', 'fdisk', 'shutdown',
        'reboot', 'halt', 'poweroff', 'init 0', 'rm -rf /*'
    ],
    'restricted_directories' => [
        '/etc', '/var/log', '/home', '/root', '/boot'
    ],
    'max_execution_time' => env('TERMINAL_CONSOLE_TIMEOUT', 300),
    'max_output_lines' => env('TERMINAL_CONSOLE_MAX_OUTPUT', 1000),
    'session_timeout' => env('TERMINAL_CONSOLE_SESSION_TIMEOUT', 3600),
    'log_commands' => env('TERMINAL_CONSOLE_LOG_COMMANDS', true),
    'allowed_users' => ['admin', 'developer', 'system_manager'],
];
```

### Environment Variables

Add these to your `.env` file:

```env
TERMINAL_CONSOLE_ENABLED=true
TERMINAL_CONSOLE_TIMEOUT=300
TERMINAL_CONSOLE_MAX_OUTPUT=1000
TERMINAL_CONSOLE_SESSION_TIMEOUT=3600
TERMINAL_CONSOLE_LOG_COMMANDS=true
```

## Usage

### Accessing the Terminal Console

1. Navigate to your Filament admin panel
2. Look for the "Terminal Console" menu item
3. Open a new terminal session

### Basic Terminal Operations

1. **Command Execution**: Type commands and press Enter
2. **File Navigation**: Use `cd`, `ls`, `pwd` for file operations
3. **File Management**: Create, edit, and delete files
4. **Process Control**: Monitor and manage system processes
5. **System Information**: Get system status and information

### Advanced Features

- **Tab Completion**: Use Tab key for command and file completion
- **Command History**: Access previous commands with arrow keys
- **Session Persistence**: Terminal sessions persist across page refreshes
- **Multi-tab Support**: Open multiple terminal tabs
- **Custom Aliases**: Create and use command aliases

### Security Features

- **Command Whitelisting**: Only allowed commands can be executed
- **Dangerous Command Blocking**: Prevents execution of harmful commands
- **Directory Restrictions**: Limits access to sensitive directories
- **User Isolation**: Each user has separate terminal sessions
- **Activity Logging**: All commands are logged for audit purposes

## Troubleshooting

### Common Issues

- **Permission denied**: Ensure the user has appropriate system access
- **Command not found**: Check if the command is in the allowed list
- **Session timeout**: Increase session timeout in configuration
- **Performance issues**: Check system resources and command complexity

### Debug Steps

1. Check the plugin configuration:
```bash
php artisan config:show terminal-console
```

2. Verify routes are registered:
```bash
php artisan route:list | grep terminal-console
```

3. Check system permissions:
```bash
# Verify the web server user has system access
sudo -l
whoami
groups
```

4. Test basic terminal functionality:
```bash
# Test if basic commands work
php artisan tinker
shell_exec('pwd');
shell_exec('ls -la');
```

5. Clear caches:
```bash
php artisan optimize:clear
```

6. Check logs for errors:
```bash
tail -f storage/logs/laravel.log
```

### Terminal-Specific Issues

#### Command Execution
- **Command blocked**: Check allowed_commands configuration
- **Permission errors**: Verify user permissions for command execution
- **Timeout issues**: Adjust max_execution_time setting

#### File Operations
- **Access denied**: Check directory restrictions and permissions
- **File not found**: Verify file paths and existence
- **Permission errors**: Check file and directory permissions

#### Process Management
- **Process not found**: Verify process exists and is accessible
- **Permission denied**: Check user permissions for process operations
- **High resource usage**: Monitor terminal resource consumption

## Security Considerations

### Access Control

- **Role-based permissions**: Restrict terminal access to authorized users only
- **Command restrictions**: Whitelist allowed commands and block dangerous ones
- **Directory restrictions**: Limit access to sensitive system directories
- **User isolation**: Ensure users can only access their own terminal sessions

### Best Practices

- Never expose terminal console to public users
- Regularly review and update command whitelists
- Monitor terminal usage and log suspicious activities
- Implement proper user authentication and authorization
- Use HTTPS for secure access
- Regular security audits of terminal access

### Command Security

- **Whitelist approach**: Only allow necessary commands
- **Input validation**: Validate all command inputs
- **Output sanitization**: Sanitize command outputs
- **Rate limiting**: Prevent command flooding attacks

## Performance Optimization

### System Requirements

- **CPU**: Sufficient CPU for command execution
- **Memory**: Adequate RAM for terminal sessions
- **Storage**: Fast storage for command operations
- **Network**: Stable network for web terminal access

### Optimization Tips

- Use command caching for repeated operations
- Implement session pooling for multiple users
- Monitor system resources during peak usage
- Optimize command execution timeouts

### Session Management

- **Session pooling**: Reuse terminal sessions when possible
- **Connection limits**: Limit concurrent terminal connections
- **Resource monitoring**: Monitor terminal resource usage
- **Cleanup strategies**: Implement proper session cleanup

## Uninstall

### 1. Remove Plugin Registration

Remove the plugin from your panel provider:
```php
// remove ->plugin(\Filaforge\TerminalConsole\TerminalConsolePlugin::make())
```

### 2. Roll Back Migrations (Optional)

```bash
php artisan migrate:rollback
# or roll back specific published files if needed
```

### 3. Remove Published Assets (Optional)

```bash
rm -f config/terminal-console.php
rm -rf resources/views/vendor/terminal-console
```

### 4. Remove Package and Clear Caches

```bash
composer remove filaforge/terminal-console
php artisan optimize:clear
```

### 5. Clean Up Environment Variables

Remove these from your `.env` file:
```env
TERMINAL_CONSOLE_ENABLED=true
TERMINAL_CONSOLE_TIMEOUT=300
TERMINAL_CONSOLE_MAX_OUTPUT=1000
TERMINAL_CONSOLE_SESSION_TIMEOUT=3600
TERMINAL_CONSOLE_LOG_COMMANDS=true
```

### 6. Security Cleanup

After uninstalling, consider:
- Reviewing system access permissions
- Cleaning up any custom terminal configurations
- Removing any scheduled tasks or cron jobs
- Updating system security settings

## Support

- **Documentation**: [GitHub Repository](https://github.com/filaforge/terminal-console)
- **Issues**: [GitHub Issues](https://github.com/filaforge/terminal-console/issues)
- **Discussions**: [GitHub Discussions](https://github.com/filaforge/terminal-console/discussions)

## Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

## License

This plugin is open-sourced software licensed under the [MIT license](LICENSE).

---

**Made with ❤️ by the Filaforge Team**

