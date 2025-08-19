# Filaforge Ollama Chat

A powerful Filament plugin that integrates Ollama AI chat capabilities directly into your admin panel for local AI model interactions.

## Features

- **Ollama AI Integration**: Chat with local AI models powered by Ollama
- **Local Model Support**: Run AI models locally without external API calls
- **Conversation Management**: Save, organize, and continue chat conversations
- **Model Selection**: Choose from available Ollama models on your system
- **Customizable Settings**: Configure Ollama server, models, and chat parameters
- **Real-time Chat**: Live chat experience with streaming responses
- **Conversation History**: Keep track of all your AI conversations
- **Export Conversations**: Save and share chat transcripts
- **Role-based Access**: Configurable user permissions and access control
- **Context Awareness**: Maintain conversation context across sessions

## Installation

### 1. Install via Composer

```bash
composer require filaforge/ollama-chat
```

### 2. Publish & Migrate

```bash
# Publish provider groups (config, views, migrations)
php artisan vendor:publish --provider="Filaforge\\OllamaChat\\Providers\\OllamaChatServiceProvider"

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
        ->plugin(\Filaforge\OllamaChat\Filament\OllamaChatPanelPlugin::make());
}
```

## Setup

### Prerequisites

Before using this plugin, you need to have Ollama installed and running on your system:

1. **Install Ollama**: Visit [ollama.ai](https://ollama.ai) and follow installation instructions
2. **Start Ollama Service**: Ensure Ollama is running on your system
3. **Download Models**: Pull the AI models you want to use

### Configuration

The plugin will automatically:
- Publish configuration files to `config/ollama-chat.php`
- Publish view files to `resources/views/vendor/ollama-chat/`
- Publish migration files to `database/migrations/`
- Register necessary routes and middleware

### Ollama Configuration

Configure your Ollama connection in the published config file:

```php
// config/ollama-chat.php
return [
    'base_url' => env('OLLAMA_BASE_URL', 'http://localhost:11434'),
    'default_model' => env('OLLAMA_MODEL', 'llama3'),
    'max_tokens' => env('OLLAMA_MAX_TOKENS', 4096),
    'temperature' => env('OLLAMA_TEMPERATURE', 0.7),
    'stream' => env('OLLAMA_STREAM', true),
    'timeout' => env('OLLAMA_TIMEOUT', 120),
    'system_prompt' => env('OLLAMA_SYSTEM_PROMPT', 'You are a helpful assistant.'),
];
```

### Environment Variables

Add these to your `.env` file:

```env
OLLAMA_BASE_URL=http://localhost:11434
OLLAMA_MODEL=llama3
OLLAMA_MAX_TOKENS=4096
OLLAMA_TEMPERATURE=0.7
OLLAMA_STREAM=true
OLLAMA_TIMEOUT=120
OLLAMA_SYSTEM_PROMPT=You are a helpful assistant.
```

### Installing Ollama Models

Install the AI models you want to use:

```bash
# Install Llama 3
ollama pull llama3

# Install Code Llama
ollama pull codellama

# Install Mistral
ollama pull mistral

# Install other models as needed
ollama list
```

## Usage

### Accessing Ollama Chat

1. Navigate to your Filament admin panel
2. Look for the "Ollama Chat" menu item
3. Start chatting with local AI models

### Starting a Conversation

1. **Select Model**: Choose from available Ollama models on your system
2. **Type Your Message**: Enter your question or prompt
3. **Send Message**: Submit your message to the local AI
4. **View Response**: See the AI's response in real-time
5. **Continue Chat**: Keep the conversation going

### Managing Conversations

1. **New Chat**: Start a fresh conversation
2. **Save Chat**: Automatically save important conversations
3. **Load Chat**: Resume previous conversations
4. **Export Chat**: Download conversation transcripts
5. **Delete Chat**: Remove unwanted conversations

### Advanced Features

- **Model Switching**: Switch between different Ollama models
- **Parameter Tuning**: Adjust temperature, max tokens, and other settings
- **Context Management**: Maintain conversation context across sessions
- **Streaming Responses**: Real-time AI responses for better user experience

## Troubleshooting

### Common Issues

- **Connection refused**: Ensure Ollama service is running on your system
- **Model not found**: Verify the model is installed with `ollama list`
- **Slow responses**: Check system resources and model size
- **Memory issues**: Ensure sufficient RAM for the selected model

### Debug Steps

1. Check the plugin configuration:
```bash
php artisan config:show ollama-chat
```

2. Verify routes are registered:
```bash
php artisan route:list | grep ollama-chat
```

3. Test Ollama connectivity:
```bash
# Check if Ollama is running
curl http://localhost:11434/api/tags

# List available models
ollama list
```

4. Check environment variables:
```bash
php artisan tinker
echo env('OLLAMA_BASE_URL');
```

5. Clear caches:
```bash
php artisan optimize:clear
```

6. Check logs for errors:
```bash
tail -f storage/logs/laravel.log
```

### Ollama Service Issues

- **Service not starting**: Check Ollama installation and permissions
- **Port conflicts**: Ensure port 11434 is available
- **Model download failures**: Check internet connection and disk space
- **Performance issues**: Monitor system resources and model size

## Security Considerations

### Access Control

- **Role-based permissions**: Restrict access to authorized users only
- **Local network security**: Ensure Ollama is not exposed to external networks
- **User isolation**: Ensure users can only access their own conversations
- **Audit logging**: Track all chat activities and model usage

### Best Practices

- Run Ollama on localhost only
- Implement proper user authentication
- Monitor system resources and model usage
- Regularly update Ollama and models
- Use appropriate firewall rules

## Performance Optimization

### System Requirements

- **RAM**: Minimum 8GB, recommended 16GB+ for larger models
- **CPU**: Multi-core processor for better performance
- **Storage**: SSD recommended for faster model loading
- **GPU**: Optional but recommended for better performance

### Model Selection

- **Small models** (1-3B parameters): Fast, lower quality
- **Medium models** (7-13B parameters): Balanced performance
- **Large models** (30B+ parameters): High quality, slower responses

## Uninstall

### 1. Remove Plugin Registration

Remove the plugin from your panel provider:
```php
// remove ->plugin(\Filaforge\OllamaChat\Filament\OllamaChatPanelPlugin::make())
```

### 2. Roll Back Migrations (Optional)

```bash
php artisan migrate:rollback
# or roll back specific published files if needed
```

### 3. Remove Published Assets (Optional)

```bash
rm -f config/ollama-chat.php
rm -rf resources/views/vendor/ollama-chat
```

### 4. Remove Package and Clear Caches

```bash
composer remove filaforge/ollama-chat
php artisan optimize:clear
```

### 5. Clean Up Environment Variables

Remove these from your `.env` file:
```env
OLLAMA_BASE_URL=http://localhost:11434
OLLAMA_MODEL=llama3
OLLAMA_MAX_TOKENS=4096
OLLAMA_TEMPERATURE=0.7
OLLAMA_STREAM=true
OLLAMA_TIMEOUT=120
OLLAMA_SYSTEM_PROMPT=You are a helpful assistant.
```

### 6. Stop Ollama Service (Optional)

If you no longer need Ollama:
```bash
# Stop Ollama service
ollama stop

# Remove models (optional)
ollama rm llama3
ollama rm codellama
```

## Support

- **Documentation**: [GitHub Repository](https://github.com/filaforge/ollama-chat)
- **Issues**: [GitHub Issues](https://github.com/filaforge/ollama-chat/issues)
- **Discussions**: [GitHub Discussions](https://github.com/filaforge/ollama-chat/discussions)

## Contributing

We welcome contributions! Please see our [Contributing Guide](CONTRIBUTING.md) for details.

## License

This plugin is open-sourced software licensed under the [MIT license](LICENSE).

---

**Made with ❤️ by the Filaforge Team**