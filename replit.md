# Lafiyar Iyali Project - Maternal Health Tracking System

## Overview
This is a Laravel + React (Inertia.js) application for tracking maternal health. The project uses:
- **Backend**: Laravel 12 (PHP 8.2)
- **Frontend**: React 19 with TypeScript, Inertia.js, and Tailwind CSS
- **Database**: SQLite (development)
- **Build Tool**: Vite 7
- **Route Generation**: Laravel Wayfinder for type-safe routing

## Project Structure
- `app/` - Laravel application code (Controllers, Models, Middleware)
- `resources/js/` - React frontend components, pages, and layouts
- `resources/js/routes/` - Auto-generated type-safe routes from Laravel Wayfinder
- `database/migrations/` - Database schema migrations
- `routes/` - Laravel route definitions
- `public/` - Public assets and entry point

## Key Features
- User authentication with Laravel Fortify
- Two-factor authentication
- Role-based access (Admin, PHC Staff)
- Patient management
- PHC (Primary Health Center) management
- Ward and LGA (Local Government Area) tracking

## Development Setup (Replit)
The application is configured to run on Replit with:
- Laravel backend on port 5000
- Vite dev server on port 5173 (for hot module replacement)
- Both servers run concurrently via the `run.sh` script

## Environment Configuration
- The `.env` file is automatically updated with the Replit domain on startup
- SQLite database is used for development
- Database migrations are already run

## Available Routes
- `/` - Welcome page
- `/login` - User login
- `/register` - User registration
- `/dashboard` - Main dashboard (role-based)
- `/patients` - Patient management
- `/settings/*` - User settings (profile, password, 2FA, appearance)

## Deployment
The project is configured for VM deployment with:
- Asset build step: `npm run build`
- Production server: PHP built-in server optimized with caching
- Automatic APP_URL configuration for Replit domains

## Recent Changes
- Initial setup for Replit environment (October 29, 2025)
- Configured Vite to allow all hosts for Replit proxy
- Fixed route imports in Welcome page to use Wayfinder-generated routes
- Set up deployment configuration

## Technologies
- Laravel 12.x
- React 19.x
- TypeScript 5.x
- Inertia.js 2.x
- Tailwind CSS 4.x
- Vite 7.x
- Laravel Fortify (authentication)
- Laravel Sanctum (API tokens)
- Laravel Wayfinder (type-safe routing)
