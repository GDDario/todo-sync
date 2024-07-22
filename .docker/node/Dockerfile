FROM node:20-alpine

WORKDIR /app

COPY ../../app/package.json .
COPY ../../app/vite.config.ts .

RUN npm install

COPY ../../app .

EXPOSE 3000

CMD ["npm", "run", "dev"]