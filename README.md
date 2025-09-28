# JBZoo / Skeleton-Php

[![CI](https://github.com/JBZoo/Skeleton-Php/actions/workflows/main.yml/badge.svg?branch=master)](https://github.com/JBZoo/Skeleton-Php/actions/workflows/main.yml?query=branch%3Amaster)    [![Coverage Status](https://coveralls.io/repos/github/JBZoo/Skeleton-PHP/badge.svg?branch=master)](https://coveralls.io/github/JBZoo/Skeleton-PHP?branch=master)    [![Psalm Coverage](https://shepherd.dev/github/JBZoo/Skeleton-Php/coverage.svg)](https://shepherd.dev/github/JBZoo/Skeleton-Php)    [![Psalm Level](https://shepherd.dev/github/JBZoo/Skeleton-Php/level.svg)](https://shepherd.dev/github/JBZoo/Skeleton-Php)    [![CodeFactor](https://www.codefactor.io/repository/github/jbzoo/skeleton-php/badge)](https://www.codefactor.io/repository/github/jbzoo/skeleton-php/issues)

## Overview

This is a project skeleton template for creating new PHP libraries within the JBZoo ecosystem. It's not a completed library but a standardized template that helps maintain consistency across JBZoo projects.

The skeleton includes:
- Modern PHP 8.2+ setup with strict typing
- Comprehensive testing framework integration
- Complete CI/CD pipeline configuration
- Integrated code quality tools (PHPStan, Psalm, PHP-CS-Fixer, etc.)
- JBZoo coding standards and conventions

## Quick Start

### Creating a New Project

1. **Create a new repository** (MIT license, without .gitignore)
2. **Clone the skeleton**:
   ```bash
   git clone https://github.com/JBZoo/Skeleton-Php.git your-project-name
   cd your-project-name
   ```
3. **Initialize the project**:
   ```bash
   make update
   php create-new-project.php Project-Name
   make update
   ```

The initialization script will:
- Replace all template placeholders with your package name
- Rename template files to match your namespace
- Update composer.json and other configuration files
- Clean up skeleton-specific files

### Development Commands

```bash
# Install/update dependencies
make update

# Develop cycle
make skel-test

# fix, commit, git reset --hard, repeat.

# Run all tests and code quality checks
make test-all

# Run individual tools
make test           # PHPUnit tests
make codestyle      # All linters
```

## Project Structure

```
├── src/                    # Main library code
├── tests/                  # PHPUnit tests
├── create-new-project.php  # Skeleton transformation script
├── Makefile               # Build commands
├── phpunit.xml.dist       # PHPUnit configuration
└── composer.json          # Dependencies and autoloading
```

## Template System

The skeleton uses placeholder tokens that get replaced during project creation:

- `__PACKAGE__` → Your package name (e.g., "MyAwesomeLib")
- `__NS__` → Your namespace (e.g., "MyAwesomeLib")
- `jbzoo/skeleton-php` → Your composer package name

Template files that get renamed:
- `src/__NS__.php` → `src/YourClassName.php`
- `tests/__NS__Test.php` → `tests/YourClassNameTest.php`

## Requirements

- PHP 8.2 or higher
- Composer 2.0+
- Make (for build commands)

## Code Quality

The skeleton includes comprehensive code quality tools:

- **PHPUnit** - Unit testing framework
- **PHPStan** - Static analysis (level max)
- **Psalm** - Additional static analysis
- **PHP-CS-Fixer** - Code style fixer
- **PHPMD** - Mess detector
- **Phan** - Static analyzer

All tools are pre-configured with JBZoo standards and integrate with CI/CD pipelines.

## CI/CD

The skeleton includes GitHub Actions workflow that:
- Tests against multiple PHP versions
- Runs all quality assurance tools
- Generates coverage reports
- Validates composer configuration

## License

MIT
