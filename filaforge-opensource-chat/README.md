# Filaforge Opensource Chat

A powerful Filament plugin that integrates various open-source AI chat capabilities directly into your admin panel.

## Features

- **Multi-Model Support**: Chat with various open-source AI models
- **Conversation Management**: Save, organize, and continue chat conversations
- **Model Selection**: Choose from available open-source AI models
- **Customizable Settings**: Configure API endpoints, models, and chat parameters
- **Real-time Chat**: Live chat experience with streaming responses
- **Conversation History**: Keep track of all your AI conversations
- **Export Conversations**: Save and share chat transcripts
- **Role-based Access**: Configurable user permissions and access control
- **Context Awareness**: Maintain conversation context across sessions
- **Local Deployment**: Support for self-hosted AI models

## Installation

### 1. Install via Composer

```bash
composer require filaforge/opensource-chat
```

### 2. Publish & Migrate

```bash
# Publish provider groups (config, views, migrations)
php artisan vendor:publish --provider="Filaforge\\OpensourceChat\\Providers\\OpensourceChatServiceProvider"

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
        ->plugin(\Filaforge\OpensourceChat\OpensourceChatPlugin::make());
}
```

## Setup

### Configuration

The plugin will automatically:
- Publish configuration files to `config/opensource-chat.php`
- Publish view files to `resources/views/vendor/opensource-chat/`
- Publish migration files to `database/migrations/`
- Register necessary routes and middleware

### Open Source AI Configuration

Configure your open-source AI endpoints in the published config file:

```php
// config/opensource-chat.php
return [
    'default_provider' => env('OS_CHAT_PROVIDER', 'local'),
    'providers' => [
        'local' => [
            'base_url' => env('OS_CHAT_LOCAL_URL', 'http://localhost:8000'),
            'api_key' => env('OS_CHAT_LOCAL_KEY', ''),
            'model' => env('OS_CHAT_LOCAL_MODEL', 'llama3'),
        ],
        'fireworks' => [
            'base_url' => env('OS_CHAT_FIREWORKS_URL', 'https://api.fireworks.ai'),
            'api_key' => env('OS_CHAT_FIREWORKS_KEY', ''),
            'model' => env('OS_CHAT_FIREWORKS_MODEL', 'llama-v2-7b-chat'),
        ],
        'together' => [
            'base_url' => env('OS_CHAT_TOGETHER_URL', 'https://api.together.xyz'),
            'api_key' => env('OS_CHAT_TOGETHER_KEY', ''),
            'model' => env('OS_CHAT_TOGETHER_MODEL', 'meta-llama/Llama-2-7b-chat-hf'),
        ],
    ],
    'max_tokens' => env('OS_CHAT_MAX_TOKENS', 4096),
    'temperature' => env('OS_CHAT_TEMPERATURE', 0.7),
    'stream' => env('OS_CHAT_STREAM', true),
    'timeout' => env('OS_CHAT_TIMEOUT', 60),
];
```

### Environment Variables

Add these to your `.env` file:

```env
OS_CHAT_PROVIDER=local
OS_CHAT_LOCAL_URL=http://localhost:8000
OS_CHAT_LOCAL_KEY=your_local_api_key_here
OS_CHAT_LOCAL_MODEL=llama3
OS_CHAT_FIREWORKS_URL=https://api.fireworks.ai
OS_CHAT_FIREWORKS_KEY=your_fireworks_api_key_here
OS_CHAT_FIREWORKS_MODEL=llama-v2-7b-chat
OS_CHAT_TOGETHER_URL=https://api.together.xyz
OS_CHAT_TOGETHER_KEY=your_together_api_key_here
OS_CHAT_TOGETHER_MODEL=meta-llama/Llama-2-7b-chat-hf
OS_CHAT_MAX_TOKENS=4096
OS_CHAT_TEMPERATURE=0.7
OS_CHAT_STREAM=true
OS_CHAT_TIMEOUT=60
```

### Getting API Keys

#### Fireworks AI
1. Visit [Fireworks AI](https://fireworks.ai/)
2. Create an account and navigate to API keys
3. Generate a new API key
4. Copy the key to your `.env` file

#### Together AI
1. Visit [Together AI](https://together.ai/)
2. Sign up and go to API keys section
3. Create a new API key
4. Copy the key to your `.env` file

#### Local Models
For local deployment, you can use:
- **Ollama**: Local model serving
- **LM Studio**: Desktop AI model interface
- **Custom endpoints**: Your own AI model servers

## Usage

### Accessing Opensource Chat

1. Navigate to your Filament admin panel
2. Look for the "Opensource Chat" menu item
3. Start chatting with open-source AI models

### Starting a Conversation

1. **Select Provider**: Choose from available AI providers
2. **Select Model**: Choose the specific AI model to use
3. **Type Your Message**: Enter your question or prompt
4. **Send Message**: Submit your message to the AI
5. **View Response**: See the AI's response in real-time
6. **Continue Chat**: Keep the conversation going

### Managing Conversations

1. **New Chat**: Start a fresh conversation
2. **Save Chat**: Automatically save important conversations
3. **Load Chat**: Resume previous conversations
4. **Export Chat**: Download conversation transcripts
5. **Delete Chat**: Remove unwanted conversations

### Advanced Features

- **Provider Switching**: Switch between different AI providers
- **Model Selection**: Choose from available models per provider
- **Parameter Tuning**: Adjust temperature, max tokens, and other settings
- **Context Management**: Maintain conversation context across sessions
- **Streaming Responses**: Real-time AI responses for better user experience

## Troubleshooting

### Common Issues

- **API key errors**: Verify your API keys are correct and have sufficient credits
- **Connection failures**: Check if the AI service endpoints are accessible
- **Model not available**: Ensure the selected model is available in your plan
- **Rate limiting**: Check your API rate limits and usage

### Debug Steps

1. Check the plugin configuration:
```bash
php artisan config:show opensource-chat
```

2. Verify routes are registered:
```bash
php artisan route:list | grep opensource-chat
```

3. Test API connectivity:
```bash
# Test local endpoint
curl http://localhost:8000/health

# Test external endpoints
curl -H "Authorization: Bearer YOUR_API_KEY" https://api.fireworks.ai/v1/models
```

4. Check environment variables:
```bash
php artisan tinker
echo env('OS_CHAT_PROVIDER');
echo env('OS_CHAT_LOCAL_URL');
```

5. Clear caches:
```bash
php artisan optimize:clear
```

6. Check logs for errors:
```bash
tail -f storage/logs/laravel.log
```

### Provider-Specific Issues

#### Local Models
- **Service not running**: Ensure your local AI service is started
- **Port conflicts**: Check if the required ports are available
- **Model not loaded**: Verify the model is properly loaded in your service

#### Fireworks AI
- **Authentication errors**: Check API key and permissions
- **Model availability**: Ensure the model is available in your plan
- **Rate limits**: Monitor your API usage and limits

#### Together AI
- **API key issues**: Verify your Together AI API key
- **Model access**: Check if you have access to the selected model
- **Service status**: Check Together AI service status

## Security Considerations

### Access Control

- **Role-based permissions**: Restrict access to authorized users only
- **API key security**: Never expose API keys in client-side code
- **User isolation**: Ensure users can only access their own conversations
- **Audit logging**: Track all chat activities and API usage

### Best Practices

- Use environment variables for API keys
- Implement proper user authentication
- Monitor API usage and costs
- Regularly rotate API keys
- Set appropriate rate limits
- Use HTTPS for external API calls

## Performance Optimization

### Local Deployment

- **Resource allocation**: Ensure sufficient RAM and CPU for models
- **Model optimization**: Use quantized models for better performance
- **Caching**: Implement response caching for common queries
- **Load balancing**: Use multiple model instances if needed

### External APIs

- **Connection pooling**: Reuse HTTP connections when possible
- **Request batching**: Batch multiple requests when feasible
- **Response caching**: Cache responses to reduce API calls
- **Fallback strategies**: Implement fallback to local models

## Uninstall

### 1. Remove Plugin Registration

Remove the plugin from your panel provider:
```php
// remove ->plugin(\Filaforge\OpensourceChat\OpensourceChatPlugin::make())
```

### 2. Roll Back Migrations (Optional)

```bash
php artisan migrate:rollback
# or roll back specific published files if needed
```

### 3. Remove Published Assets (Optional)

```bash
rm -f config/opensource-chat.php
rm -rf resources/views/vendor/opensource-chat
```

### 4. Remove Package and Clear Caches

```bash
composer remove filaforge/opensource-chat
php artisan optimize:clear
```

### 5. Clean Up Environment Variables

Remove these from your `.env` file:
```env
OS_CHAT_PROVIDER=local
OS_CHAT_LOCAL_URL=http://localhost:8000
OS_CHAT_LOCAL_KEY=your_local_api_key_here
OS_CHAT_LOCAL_MODEL=llama3
OS_CHAT_FIREWORKS_URL=https://api.fireworks.ai
OS_CHAT_FIREWORKS_KEY=your_fireworks_api_key_here
OS_CHAT_FIREWORKS_MODEL=llama-v2-7b-chat
OS_CHAT_TOGETHER_URL=https://api.together.xyz
OS_CHAT_TOGETHER_KEY=your_together_api_key_here
OS_CHAT_TOGETHER_MODEL=meta-llama/Llama-2-7b-chat-hf
OS_CHAT_MAX_TOKENS=4096
OS_CHAT_TEMPERATURE=0.7
OS_CHAT_STREAM=true
OS_CHAT_TIMEOUT=60
```

## Support

- **Documentation**: [GitHub Repository](https://github.com/filaforge/opensource-chat)
- **Issues**: [GitHub Issues](https://github.com/filaforge/opensource-chat/issues)
- **Discussions**: [GitHub Discussions](https://github.com/filaforge/opensource-chat/discussions)

## Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

## License

This plugin is open-sourced software licensed under the [MIT license](LICENSE).

---

**Made with ❤️ by the Filaforge Team**
