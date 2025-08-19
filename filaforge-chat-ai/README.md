# Filaforge Chat AI

A powerful Filament plugin that integrates AI chat capabilities directly into your admin panel.

## Features

- **AI Chat Interface**: Seamless chat experience with AI models
- **Multiple AI Providers**: Support for various AI services
- **Conversation History**: Keep track of all your AI conversations
- **Customizable Prompts**: Create and save custom prompt templates
- **File Upload Support**: Send files to AI for analysis
- **Response Export**: Save and share AI responses
- **Real-time Chat**: Live chat experience with streaming responses

## Installation

### 1. Install via Composer

```bash
composer require filaforge/chat-ai
```

### 2. Publish & Migrate

```bash
# Publish provider groups (config, views, migrations)
php artisan vendor:publish --provider="Filaforge\\ChatAi\\Providers\\ChatAiServiceProvider"

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
        ->plugin(\Filaforge\ChatAi\Providers\ChatAiPanelPlugin::make());
}
```

## Setup

### Configuration

The plugin will automatically:
- Publish configuration files to `config/chat-ai.php`
- Publish view files to `resources/views/vendor/chat-ai/`
- Publish migration files to `database/migrations/`
- Register necessary routes and middleware

### AI Provider Configuration

Configure your AI provider in the published config file:

```php
// config/chat-ai.php
return [
    'default_provider' => 'openai',
    'providers' => [
        'openai' => [
            'api_key' => env('OPENAI_API_KEY'),
            'model' => 'gpt-4',
        ],
        'anthropic' => [
            'api_key' => env('ANTHROPIC_API_KEY'),
            'model' => 'claude-3-sonnet',
        ],
    ],
];
```

### Environment Variables

Add these to your `.env` file:

```env
OPENAI_API_KEY=your_openai_api_key_here
ANTHROPIC_API_KEY=your_anthropic_api_key_here
```

## Usage

### Accessing the Chat AI

1. Navigate to your Filament admin panel
2. Look for the "Chat AI" menu item
3. Start chatting with AI models

### Starting a Conversation

1. **Select AI Model**: Choose from available AI providers
2. **Type Your Message**: Enter your question or prompt
3. **Send Message**: Submit your message to the AI
4. **View Response**: See the AI's response in real-time
5. **Continue Chat**: Keep the conversation going

### Advanced Features

- **File Uploads**: Send documents, images, or other files
- **Prompt Templates**: Save and reuse common prompts
- **Conversation Export**: Download chat history
- **Custom Settings**: Adjust AI parameters and behavior

## Troubleshooting

### Common Issues

- **API key errors**: Verify your API keys are correct and have sufficient credits
- **Rate limiting**: Check your AI provider's rate limits
- **Model not available**: Ensure the selected model is available in your plan
- **File upload issues**: Check file size limits and supported formats

### Debug Steps

1. Check the plugin configuration:
```bash
php artisan config:show chat-ai
```

2. Verify routes are registered:
```bash
php artisan route:list | grep chat-ai
```

3. Test API connectivity:
```bash
php artisan tinker
# Test your API keys manually
```

4. Clear caches:
```bash
php artisan optimize:clear
```

5. Check logs for errors:
```bash
tail -f storage/logs/laravel.log
```

## Uninstall

### 1. Remove Plugin Registration

Remove the plugin from your panel provider:
```php
// remove ->plugin(\Filaforge\ChatAi\Providers\ChatAiPanelPlugin::make())
```

### 2. Roll Back Migrations (Optional)

```bash
php artisan migrate:rollback
# or roll back specific published files if needed
```

### 3. Remove Published Assets (Optional)

```bash
rm -f config/chat-ai.php
rm -rf resources/views/vendor/chat-ai
```

### 4. Remove Package and Clear Caches

```bash
composer remove filaforge/chat-ai
php artisan optimize:clear
```

## Support

- **Documentation**: [GitHub Repository](https://github.com/filaforge/chat-ai)
- **Issues**: [GitHub Issues](https://github.com/filaforge/chat-ai/issues)
- **Discussions**: [GitHub Discussions](https://github.com/filaforge/chat-ai/discussions)

## Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

## License

This plugin is open-sourced software licensed under the [MIT license](LICENSE).

---

**Made with ❤️ by the Filaforge Team**


















