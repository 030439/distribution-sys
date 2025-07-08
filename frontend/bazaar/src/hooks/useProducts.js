import { useState, useEffect } from 'react';

/**
 * Custom hook to fetch products from the API
 * @param {Object} options - Configuration options
 * @param {number} options.limit - Maximum number of products to fetch
 * @param {boolean} options.calculateStats - Whether to calculate statistics from products
 * @returns {Object} Products data, loading state, error state, and statistics
 */
function useProducts({ limit = null, calculateStats = false } = {}) {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [stats, setStats] = useState({
    totalProducts: 0,
    totalRevenue: 0,
    lowStock: 0,
    activeProducts: 0
  });

  useEffect(() => {
    const fetchProducts = async () => {
      setLoading(true);
      try {
        const response = await fetch('/api/products');
        
        if (!response.ok) {
          throw new Error(`Error ${response.status}: ${response.statusText}`);
        }
        
        const data = await response.json();
        const productsList = data.data || [];
        
        // Apply limit if specified
        const limitedProducts = limit ? productsList.slice(0, limit) : productsList;
        setProducts(limitedProducts);
        
        // Calculate statistics if requested
        if (calculateStats && productsList.length > 0) {
          setStats({
            totalProducts: productsList.length,
            totalRevenue: productsList.reduce((sum, product) => 
              sum + (product.price * product.stock_quantity), 0),
            lowStock: productsList.filter(product => product.stock_quantity < 10).length,
            activeProducts: productsList.filter(product => product.active).length
          });
        }
        
        setError(null);
      } catch (err) {
        console.error('Error fetching products:', err);
        setError('Failed to load products');
        setProducts([]);
      } finally {
        setLoading(false);
      }
    };

    fetchProducts();
  }, [limit, calculateStats]);

  return { products, loading, error, stats };
}

export default useProducts;
