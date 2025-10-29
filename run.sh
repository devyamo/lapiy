#!/bin/bash
set -e

# Update APP_URL with Replit domain
if [ ! -z "$REPLIT_DOMAINS" ]; then
    sed -i "s|APP_URL=.*|APP_URL=https://${REPLIT_DOMAINS}|g" .env
fi

# Run both Laravel (on localhost:8000) and Vite concurrently
# Laravel will serve on 8000, Vite on 5173
# We'll use PHP's built-in server configured to forward to port 5000
npx concurrently \
  --kill-others \
  --names "Laravel,Vite" \
  -c "blue,magenta" \
  "php artisan serve --host=0.0.0.0 --port=5000" \
  "npm run dev"
