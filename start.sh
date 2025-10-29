#!/bin/bash
set -e

# Update APP_URL with Replit domain
if [ ! -z "$REPLIT_DOMAINS" ]; then
    sed -i "s|APP_URL=.*|APP_URL=https://${REPLIT_DOMAINS}|g" .env
fi

# Run Laravel backend on port 8000 and Vite on port 5173
# Then proxy through a simple PHP router on port 5000
php -S 0.0.0.0:5000 -t public &
BACKEND_PID=$!

# Start Vite dev server
npm run dev &
VITE_PID=$!

# Wait for both processes
wait $BACKEND_PID $VITE_PID
