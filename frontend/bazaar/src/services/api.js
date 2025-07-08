/**
 * Service for handling API requests
 */
const API_BASE_URL = '/api';

/**
 * Generic request handler
 */
async function request(endpoint, options = {}) {
  const headers = {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    ...options.headers
  };

  const config = {
    method: options.method || 'GET',
    headers,
    credentials: 'include',
    ...options
  };

  if (options.body && typeof options.body === 'object') {
    config.body = JSON.stringify(options.body);
  }

  try {
    const response = await fetch(`${API_BASE_URL}/${endpoint}`, config);
    const data = await response.json();

    if (!response.ok) {
      throw {
        status: response.status,
        message: data.message || 'An error occurred',
        errors: data.errors || null
      };
    }

    return data;
  } catch (error) {
    console.error(`API Error (${endpoint}):`, error);
    throw error;
  }
}

/**
 * Product-related API methods
 */
export const productAPI = {
  getAll: () => request('products'),
  getById: (id) => request(`products/${id}`),
  create: (productData) => request('products', { 
    method: 'POST',
    body: productData
  }),
  update: (id, productData) => request(`products/${id}`, { 
    method: 'PUT',
    body: productData
  }),
  delete: (id) => request(`products/${id}`, { method: 'DELETE' })
};

/**
 * Order-related API methods
 */
export const orderAPI = {
  getAll: () => request('orders'),
  getById: (id) => request(`orders/${id}`),
  create: (orderData) => request('orders', { 
    method: 'POST',
    body: orderData
  }),
  update: (id, orderData) => request(`orders/${id}`, { 
    method: 'PUT',
    body: orderData
  }),
  delete: (id) => request(`orders/${id}`, { method: 'DELETE' })
};

/**
 * Customer-related API methods
 */
export const customerAPI = {
  getAll: () => request('customers'),
  getById: (id) => request(`customers/${id}`),
  create: (customerData) => request('customers', { 
    method: 'POST',
    body: customerData
  }),
  update: (id, customerData) => request(`customers/${id}`, { 
    method: 'PUT',
    body: customerData
  }),
  delete: (id) => request(`customers/${id}`, { method: 'DELETE' })
};

/**
 * Authentication-related API methods
 */
export const authAPI = {
  login: (credentials) => request('login', {
    method: 'POST',
    body: credentials
  }),
  logout: () => request('logout', { method: 'POST' }),
  getUser: () => request('user')
};

export default {
  products: productAPI,
  orders: orderAPI,
  customers: customerAPI,
  auth: authAPI
};
