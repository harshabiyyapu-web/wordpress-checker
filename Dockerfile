# ── Stage 1: Install production dependencies ──────────────────────
FROM node:20-alpine AS builder
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci --omit=dev

# ── Stage 2: Lean production image ────────────────────────────────
FROM node:20-alpine
WORKDIR /app

# Run as non-root for security
RUN addgroup -S appgroup && adduser -S appuser -G appgroup

COPY --from=builder /app/node_modules ./node_modules
COPY server.js ./
COPY public ./public

USER appuser

EXPOSE 3000
CMD ["node", "server.js"]
