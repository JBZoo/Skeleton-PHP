# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

JBZoo Skeleton-Php is a project skeleton template for creating new PHP libraries within the JBZoo ecosystem. This is not a completed library but a template that gets transformed into a new project via the `create-new-project.php` script.

## Architecture

### Skeleton System
- **Template transformation**: The project uses placeholder tokens (`__PACKAGE__`, `__NS__`, etc.) that get replaced during project creation
- **Self-destructing setup script**: `create-new-project.php` transforms the skeleton and then deletes itself
- **Namespace mapping**: Template files like `src/__NS__.php` get renamed to actual class names during setup

### Core Structure
- `src/` - Main library code with skeleton classes
- `tests/` - PHPUnit tests extending JBZoo's testing framework
- Template files use `__NS__` and `__PACKAGE__` placeholders that get replaced during project initialization

## Common Commands

### Development
```bash
make update          # Install/update all dependencies
make autoload        # Dump optimized autoloader
```

### Testing
```bash
make test           # Run PHPUnit tests
make test-all       # Run all tests and code style checks
make codestyle      # Run all linters at once
```

### Individual QA Tools
```bash
make test-phpstan        # Static analysis with PHPStan
make test-psalm          # Static analysis with Psalm
make test-phpcsfixer     # Check PHP-CS-Fixer rules
make test-phpcsfixer-fix # Auto-fix with PHP-CS-Fixer
make test-phpmd          # Mess detector
make test-phan          # Phan static analyzer
make test-composer       # Validate composer files
```

### Project Creation
```bash
php create-new-project.php YourPackageName  # Transform skeleton into new project
make skel-test          # Test the skeleton transformation process
```

## JBZoo Standards

### PHP Requirements
- PHP 8.2+ required (`composer.json` specifies `"php": "^8.2"`)
- Strict types declaration required (`declare(strict_types=1)`)
- PSR-4 autoloading with `JBZoo\` namespace prefix

### Testing Framework
Tests extend JBZoo's testing framework classes:
- `AbstractPackageTest` - For package-level tests (validates structure, composer.json, etc.)
- Standard PHPUnit tests for functionality
- Uses custom assertion helpers like `isSame()` instead of `assertEquals()`

### Code Style
Uses JBZoo Codestyle package (`jbzoo/toolbox-dev`) which includes:
- PHP-CS-Fixer with custom JBZoo rules
- PHPStan for static analysis
- Psalm for additional static analysis
- PHPMD for mess detection
- PSR-12 compliance

## File Structure Notes

### Template Files
- `src/__NS__.php` → Gets renamed to actual namespace class during setup
- `tests/__NS__Test.php` → Becomes the main test class
- `tests/__NS__PackageTest.php` → Package validation tests

### Configuration
- `phpunit.xml.dist` - PHPUnit configuration with coverage reporting
- `Makefile` - Includes JBZoo's codestyle Makefiles for consistent tooling
- `.phan.php` - Phan static analyzer configuration

### Build System
The project uses JBZoo's sophisticated Makefile system:
- Main `Makefile` includes `vendor/jbzoo/codestyle/src/init.Makefile`
- Provides unified commands across all JBZoo projects
- Supports both local development and CI environments

## Development Workflow

1. **For new projects**: Use `php create-new-project.php PackageName` to transform skeleton
2. **For skeleton development**: Use `make skel-test` to test the transformation process
3. **Always run**: `make test-all` before committing to ensure all QA checks pass
4. **For fixes**: Use `make test-phpcsfixer-fix` to auto-fix code style issues

## CI Integration

- GitHub Actions workflow in `.github/workflows/main.yml`
- Automated testing across multiple PHP versions
- Coverage reporting integration with Coveralls
- All QA tools run in CI pipeline