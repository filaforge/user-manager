# Filaforge User Manager

A comprehensive Filament plugin that provides advanced user management capabilities including user CRUD operations, role management, permissions, and user activity tracking.

## Features

- **User Management**: Complete CRUD operations for user accounts
- **Role Management**: Create, edit, and assign user roles
- **Permission System**: Granular permission control for different actions
- **User Profiles**: Detailed user profile management and customization
- **Activity Tracking**: Monitor user login history and activity logs
- **Bulk Operations**: Perform actions on multiple users simultaneously
- **User Import/Export**: Import users from CSV/Excel and export user data
- **Password Management**: Secure password policies and reset functionality
- **User Groups**: Organize users into logical groups and teams
- **Audit Logging**: Comprehensive audit trail for all user operations
- **API Integration**: RESTful API endpoints for user management
- **Multi-tenancy Support**: Support for multi-tenant applications

## Installation

### 1. Install via Composer

```bash
composer require filaforge/user-manager
```

### 2. Publish & Migrate

```bash
# Publish provider groups (config, views, migrations)
php artisan vendor:publish --provider="Filaforge\\UserManager\\Providers\\UserManagerServiceProvider"

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
        ->plugin(\Filaforge\UserManager\UserManagerPlugin::make());
}
```

## Setup

### Prerequisites

Before using this plugin, ensure your system meets these requirements:

- **Laravel Installation**: Laravel 10+ with proper database setup
- **Filament Panel**: Configured Filament admin panel
- **Database**: MySQL, PostgreSQL, or SQLite database
- **User Model**: Laravel's default User model or custom user model
- **Authentication**: Laravel's authentication system configured

### Configuration

The plugin will automatically:
- Publish configuration files to `config/user-manager.php`
- Publish view files to `resources/views/vendor/user-manager/`
- Publish migration files to `database/migrations/`
- Register necessary routes and middleware

### User Manager Configuration

Configure the user manager in the published config file:

```php
// config/user-manager.php
return [
    'enabled' => env('USER_MANAGER_ENABLED', true),
    'models' => [
        'user' => \App\Models\User::class,
        'role' => \Filaforge\UserManager\Models\Role::class,
        'permission' => \Filaforge\UserManager\Models\Permission::class,
    ],
    'features' => [
        'roles' => env('USER_MANAGER_ROLES_ENABLED', true),
        'permissions' => env('USER_MANAGER_PERMISSIONS_ENABLED', true),
        'activity_logging' => env('USER_MANAGER_ACTIVITY_LOGGING', true),
        'bulk_operations' => env('USER_MANAGER_BULK_OPERATIONS', true),
        'import_export' => env('USER_MANAGER_IMPORT_EXPORT', true),
        'user_groups' => env('USER_MANAGER_USER_GROUPS', true),
    ],
    'security' => [
        'password_min_length' => env('USER_MANAGER_PASSWORD_MIN_LENGTH', 8),
        'password_requirements' => [
            'uppercase' => true,
            'lowercase' => true,
            'numbers' => true,
            'symbols' => true,
        ],
        'session_timeout' => env('USER_MANAGER_SESSION_TIMEOUT', 3600),
        'max_login_attempts' => env('USER_MANAGER_MAX_LOGIN_ATTEMPTS', 5),
        'lockout_duration' => env('USER_MANAGER_LOCKOUT_DURATION', 900),
    ],
    'notifications' => [
        'welcome_email' => env('USER_MANAGER_WELCOME_EMAIL', true),
        'password_reset' => env('USER_MANAGER_PASSWORD_RESET', true),
        'account_locked' => env('USER_MANAGER_ACCOUNT_LOCKED', true),
        'role_changed' => env('USER_MANAGER_ROLE_CHANGED', true),
    ],
    'pagination' => [
        'users_per_page' => env('USER_MANAGER_USERS_PER_PAGE', 25),
        'roles_per_page' => env('USER_MANAGER_ROLES_PER_PAGE', 20),
        'permissions_per_page' => env('USER_MANAGER_PERMISSIONS_PER_PAGE', 30),
    ],
];
```

### Environment Variables

Add these to your `.env` file:

```env
USER_MANAGER_ENABLED=true
USER_MANAGER_ROLES_ENABLED=true
USER_MANAGER_PERMISSIONS_ENABLED=true
USER_MANAGER_ACTIVITY_LOGGING=true
USER_MANAGER_BULK_OPERATIONS=true
USER_MANAGER_IMPORT_EXPORT=true
USER_MANAGER_USER_GROUPS=true
USER_MANAGER_PASSWORD_MIN_LENGTH=8
USER_MANAGER_SESSION_TIMEOUT=3600
USER_MANAGER_MAX_LOGIN_ATTEMPTS=5
USER_MANAGER_LOCKOUT_DURATION=900
USER_MANAGER_WELCOME_EMAIL=true
USER_MANAGER_PASSWORD_RESET=true
USER_MANAGER_ACCOUNT_LOCKED=true
USER_MANAGER_ROLE_CHANGED=true
USER_MANAGER_USERS_PER_PAGE=25
USER_MANAGER_ROLES_PER_PAGE=20
USER_MANAGER_PERMISSIONS_PER_PAGE=30
```

## Usage

### Accessing User Management

1. Navigate to your Filament admin panel
2. Look for the "User Management" menu section
3. Access Users, Roles, and Permissions as needed

### User Management

#### Creating Users
1. Navigate to Users → Create User
2. Fill in required user information
3. Assign roles and permissions
4. Set password or enable password reset
5. Save the user

#### Editing Users
1. Navigate to Users → Select User
2. Modify user information as needed
3. Update roles and permissions
4. Change password if required
5. Save changes

#### Deleting Users
1. Navigate to Users → Select User
2. Click Delete button
3. Confirm deletion
4. Handle user data cleanup

### Role Management

#### Creating Roles
1. Navigate to Roles → Create Role
2. Define role name and description
3. Assign permissions to the role
4. Set role hierarchy if applicable
5. Save the role

#### Managing Permissions
1. Navigate to Permissions → Create Permission
2. Define permission name and description
3. Assign permission to roles
4. Set permission scope and conditions
5. Save the permission

### Bulk Operations

#### Bulk User Actions
1. Select multiple users from the list
2. Choose action (activate, deactivate, delete, etc.)
3. Confirm bulk operation
4. Monitor operation progress

#### User Import/Export
1. **Import Users**:
   - Prepare CSV/Excel file with user data
   - Navigate to Users → Import
   - Upload file and map columns
   - Review and confirm import

2. **Export Users**:
   - Navigate to Users → Export
   - Select export format (CSV, Excel, JSON)
   - Choose fields to export
   - Download exported file

### User Groups

#### Creating Groups
1. Navigate to User Groups → Create Group
2. Define group name and description
3. Add users to the group
4. Set group permissions
5. Save the group

#### Managing Groups
1. Edit group membership
2. Update group permissions
3. Monitor group activity
4. Archive inactive groups

## Troubleshooting

### Common Issues

- **Users not appearing**: Check user model configuration and relationships
- **Permission errors**: Verify role and permission assignments
- **Migration failures**: Check database connection and table structure
- **Performance issues**: Optimize queries and enable caching

### Debug Steps

1. Check the plugin configuration:
```bash
php artisan config:show user-manager
```

2. Verify routes are registered:
```bash
php artisan route:list | grep user-manager
```

3. Check database tables:
```bash
php artisan migrate:status
php artisan db:show
```

4. Test user model relationships:
```bash
php artisan tinker
$user = \App\Models\User::first();
$user->roles;
$user->permissions;
```

5. Clear caches:
```bash
php artisan optimize:clear
php artisan config:clear
php artisan route:clear
```

6. Check logs for errors:
```bash
tail -f storage/logs/laravel.log
```

### User-Specific Issues

#### User Creation
- **Validation errors**: Check required fields and validation rules
- **Duplicate emails**: Verify email uniqueness constraints
- **Password issues**: Check password policy requirements

#### Role Assignment
- **Role not found**: Verify role exists and is active
- **Permission denied**: Check user's role permissions
- **Hierarchy issues**: Verify role hierarchy configuration

#### Authentication
- **Login failures**: Check user status and lockout settings
- **Session issues**: Verify session configuration
- **Permission errors**: Check role and permission assignments

## Security Considerations

### Access Control

- **Role-based access**: Implement proper role hierarchy
- **Permission granularity**: Use specific permissions for actions
- **User isolation**: Ensure users can only access appropriate data
- **Audit logging**: Track all user management activities

### Best Practices

- Regularly review and update user roles and permissions
- Implement strong password policies
- Monitor user activity and suspicious behavior
- Use HTTPS for secure access
- Regular security audits of user access

### Data Protection

- **Personal information**: Handle user data according to privacy regulations
- **Password security**: Use secure password hashing and policies
- **Session management**: Implement secure session handling
- **Data retention**: Define data retention and deletion policies

## Performance Optimization

### System Requirements

- **Database**: Optimized database with proper indexing
- **Memory**: Sufficient RAM for user operations
- **Storage**: Fast storage for user data and logs
- **Network**: Stable network for user management operations

### Optimization Tips

- Enable database query caching
- Implement user data pagination
- Use database indexes for frequently queried fields
- Monitor and optimize slow queries
- Implement user data archiving for inactive users

### Caching Strategy

- **User data caching**: Cache frequently accessed user information
- **Role caching**: Cache role and permission data
- **Query result caching**: Cache complex query results
- **Cache invalidation**: Implement proper cache invalidation

## Uninstall

### 1. Remove Plugin Registration

Remove the plugin from your panel provider:
```php
// remove ->plugin(\Filaforge\UserManager\UserManagerPlugin::make())
```

### 2. Roll Back Migrations (Optional)

```bash
php artisan migrate:rollback
# or roll back specific published files if needed
```

### 3. Remove Published Assets (Optional)

```bash
rm -f config/user-manager.php
rm -rf resources/views/vendor/user-manager
```

### 4. Remove Package and Clear Caches

```bash
composer remove filaforge/user-manager
php artisan optimize:clear
```

### 5. Clean Up Environment Variables

Remove these from your `.env` file:
```env
USER_MANAGER_ENABLED=true
USER_MANAGER_ROLES_ENABLED=true
USER_MANAGER_PERMISSIONS_ENABLED=true
USER_MANAGER_ACTIVITY_LOGGING=true
USER_MANAGER_BULK_OPERATIONS=true
USER_MANAGER_IMPORT_EXPORT=true
USER_MANAGER_USER_GROUPS=true
USER_MANAGER_PASSWORD_MIN_LENGTH=8
USER_MANAGER_SESSION_TIMEOUT=3600
USER_MANAGER_MAX_LOGIN_ATTEMPTS=5
USER_MANAGER_LOCKOUT_DURATION=900
USER_MANAGER_WELCOME_EMAIL=true
USER_MANAGER_PASSWORD_RESET=true
USER_MANAGER_ACCOUNT_LOCKED=true
USER_MANAGER_ROLE_CHANGED=true
USER_MANAGER_USERS_PER_PAGE=25
USER_MANAGER_ROLES_PER_PAGE=20
USER_MANAGER_PERMISSIONS_PER_PAGE=30
```

### 6. Data Cleanup

After uninstalling, consider:
- Removing user management tables
- Cleaning up user-related data
- Removing custom user management code
- Updating authentication configuration
- Reviewing user access policies

## Support

- **Documentation**: [GitHub Repository](https://github.com/filaforge/user-manager)
- **Issues**: [GitHub Issues](https://github.com/filaforge/user-manager/issues)
- **Discussions**: [GitHub Discussions](https://github.com/filaforge/user-manager/discussions)

## Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

## License

This plugin is open-sourced software licensed under the [MIT license](LICENSE).

---

**Made with ❤️ by the Filaforge Team**


