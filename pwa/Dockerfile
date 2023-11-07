#syntax=docker/dockerfile:1.4


# Versions
FROM node:20-alpine AS node_upstream


# Base stage for dev and build
FROM node_upstream AS base

# Check https://github.com/nodejs/docker-node/tree/b4117f9333da4138b03a546ec926ef50a31506c3#nodealpine to understand why libc6-compat might be needed.
# hadolint ignore=DL3018
RUN apk add --no-cache libc6-compat

WORKDIR /srv/app

RUN corepack yarn install

COPY package.json ./
COPY yarn.lock ./

# Development image
FROM base as dev

EXPOSE 3000
ENV PORT 3000
ENV HOSTNAME localhost
ENV NUXT_HOST=0.0.0.0
ENV NUXT_PORT=3000

CMD ["sh", "-c", "yarn install; yarn dev"]


FROM base AS builder

COPY --link yarn-lock.yaml ./
RUN yarn fetch --prod

COPY --link . .

RUN	yarn install --frozen-lockfile --offline --prod && \
	yarn run build


# Production image, copy all the files and run next
FROM node_upstream AS prod

WORKDIR /srv/app

ENV NODE_ENV production
# Delete the following line in case you want to enable telemetry during runtime.
ENV NEXT_TELEMETRY_DISABLED 1

RUN addgroup --system --gid 1001 nodejs; \
	adduser --system --uid 1001 nextjs

COPY --from=builder --link /srv/app/public ./public

# Set the correct permission for prerender cache
RUN mkdir _nuxt; \
	chown nextjs:nodejs _nuxt

# Automatically leverage output traces to reduce image size
# https://nextjs.org/docs/advanced-features/output-file-tracing
COPY --from=builder --link --chown=1001:1001 /srv/app/_nuxt/standalone ./
COPY --from=builder --link --chown=1001:1001 /srv/app/_nuxt/static ./_nuxt/static

USER nextjs

EXPOSE 3000

ENV PORT 3000
ENV HOSTNAME "0.0.0.0"

CMD ["node", "server.js"]
