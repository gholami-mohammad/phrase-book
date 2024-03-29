const PROXY_CONFIG = {
  '/api/': {
    target: {
      host: 'localhost',
      protocol: 'http:',
      port: 9090,
    },
    secure: false,
    changeOrigin: true,
    logLevel: 'debug',
  },
};

module.exports = PROXY_CONFIG;
