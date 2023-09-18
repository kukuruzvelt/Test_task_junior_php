# Use an official Node.js runtime as the base image
FROM node:14

# Set the working directory in the container
WORKDIR /app

# Copy package.json and package-lock.json to the working directory
COPY package*.json ./

# Install project dependencies
RUN npm install

# Copy the rest of the application code to the container
COPY . .

# Build the Vue.js project for production
RUN npm run build

# Expose the port your Vue.js app runs on (default is 8080)
EXPOSE 8080

# Command to start your Vue.js app (adjust as needed)
CMD ["npm", "run", "dev"]