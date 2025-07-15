import React, { useState, useEffect, useMemo } from 'react';
import './BazaarTheme.css';
import './Products.css';

function Products() {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [formData, setFormData] = useState({
    name: '',
    description: '',
    price: '',
    stock_quantity: '',
    sku: '',
    active: true,
    image_url: ''
  });
  const [isEditing, setIsEditing] = useState(false);
  const [currentProductId, setCurrentProductId] = useState(null);
  const [showForm, setShowForm] = useState(false); // State to toggle between form and inventory
  
  // Search and pagination state
  const [searchTerm, setSearchTerm] = useState('');
  const [currentPage, setCurrentPage] = useState(1);
  const [itemsPerPage] = useState(5);
  
  // Filter state
  const [showFilters, setShowFilters] = useState(false);
  const [filters, setFilters] = useState({
    status: 'all', // 'all', 'active', or 'inactive'
    stock: 'all',  // 'all', 'in-stock', or 'out-of-stock'
  });

  // fetch products on component mount
  useEffect(() => {
    fetchProducts();
  }, []);

  const fetchProducts = async () => {
    setLoading(true);
    try {
      const response = await fetch('/api/products'); //api call
      if (!response.ok) {
        throw new Error('Failed to fetch products');
      }
      const data = await response.json();
      setProducts(data.data);
      setError(null);
    } catch (err) {
      console.error('Error fetching products:', err);
      setError('Failed to load products. Please try again later.');
    } finally {
      setLoading(false);
    }
  };

  const handleInputChange = (e) => {
    const { name, value, type, checked } = e.target;
    setFormData({
      ...formData,
      [name]: type === 'checkbox' ? checked : value
    });
  };

  const resetForm = () => {
    setFormData({
      name: '',
      description: '',
      price: '',
      stock_quantity: '',
      sku: '',
      active: true,
      image_url: ''
    });
    setIsEditing(false);
    setCurrentProductId(null);
  };
  
  // Function to handle switching between form and inventory views
  const toggleView = (show = false, editProduct = null) => {
    if (editProduct) {
      handleEdit(editProduct);
    } else {
      resetForm();
    }
    setShowForm(show);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    
    try {
      // Format data properly before sending
      const dataToSend = {
        ...formData,
        price: parseFloat(formData.price),
        stock_quantity: parseInt(formData.stock_quantity, 10),
        active: Boolean(formData.active)
      };
      
      const url = isEditing ? `/api/products/${currentProductId}` : '/api/products';
      const method = isEditing ? 'PUT' : 'POST';
      
      const response = await fetch(url, {
        method: method,
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        credentials: 'include',
        body: JSON.stringify(dataToSend)
      });
      
      const responseData = await response.json();
      
      if (!response.ok) {
        if (responseData.errors) {
          // Handle validation errors
          const errorMessages = Object.values(responseData.errors).flat().join('\n');
          throw new Error(errorMessages || 'Validation failed');
        } else {
          throw new Error(responseData.message || 'Something went wrong');
        }
      }
      
      await fetchProducts();
      resetForm();
      setShowForm(false); // Return to inventory view after successful save
    } catch (err) {
      console.error('Error saving product:', err);
      setError(err.message);
    }
  };

  const handleEdit = (product) => {
    setFormData({
      name: product.name,
      description: product.description || '',
      price: product.price,
      stock_quantity: product.stock_quantity,
      sku: product.sku,
      active: product.active,
      image_url: product.image_url || ''
    });
    setIsEditing(true);
    setCurrentProductId(product.id);
    setShowForm(true); // Show the form when editing
  };

  const handleDelete = async (id) => {
    if (!window.confirm('Are you sure you want to delete this product?')) {
      return;
    }
    
    try {
      const response = await fetch(`/api/products/${id}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        credentials: 'include'
      });
      
      if (!response.ok) {
        throw new Error('Failed to delete product');
      }
      
      await fetchProducts();
    } catch (err) {
      console.error('Error deleting product:', err);
      setError('Failed to delete product. Please try again.');
    }
  };

  // Handle search input change
  const handleSearch = (e) => {
    setSearchTerm(e.target.value);
    setCurrentPage(1); // Reset to first page when searching
  };
  
  // Toggle filters visibility
  const toggleFilters = () => {
    setShowFilters(!showFilters);
  };

  // Handle filter change
  const handleFilterChange = (e) => {
    const { name, value } = e.target;
    setFilters({
      ...filters,
      [name]: value
    });
    setCurrentPage(1); // Reset to first page when changing filters
  };
  
  // Apply all filters (search and dropdown filters)
  const filteredProducts = useMemo(() => {
    return products.filter(product => {
      // Text search filter
      const matchesSearch = 
        product.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
        product.sku.toLowerCase().includes(searchTerm.toLowerCase()) ||
        (product.description && product.description.toLowerCase().includes(searchTerm.toLowerCase()));
      
      // Status filter
      const matchesStatus = 
        filters.status === 'all' || 
        (filters.status === 'active' ? product.active : !product.active);
      
      // Stock filter
      const matchesStock = 
        filters.stock === 'all' || 
        (filters.stock === 'in-stock' ? product.stock_quantity > 0 : product.stock_quantity === 0);
      
      return matchesSearch && matchesStatus && matchesStock;
    });
  }, [products, searchTerm, filters]);
  
  // Get current products for pagination
  const indexOfLastItem = currentPage * itemsPerPage;
  const indexOfFirstItem = indexOfLastItem - itemsPerPage;
  const currentProducts = filteredProducts.slice(indexOfFirstItem, indexOfLastItem);
  
  // Change page
  const paginate = (pageNumber) => setCurrentPage(pageNumber);
  
  // Calculate total pages
  const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);

  // Reset all filters to default
  const resetFilters = () => {
    setFilters({
      status: 'all',
      stock: 'all'
    });
    setCurrentPage(1);
  };

  return (
    <div className="products-container">
      <h2>Products Management</h2>
      
      {error && <div className="alert alert-danger">{error}</div>}
      
      {showForm ? (
        <div className="product-form-container">
          <div className="form-header">
            <h3>{isEditing ? 'Edit Product' : 'Add New Product'}</h3>
            <button type="button" className="btn-back" onClick={() => toggleView(false)}>
              Back to Inventory
            </button>
          </div>
          <form onSubmit={handleSubmit} className="product-form">
            <div className="form-group required">
              <label htmlFor="name">Product Name</label>
              <input
                type="text"
                id="name"
                name="name"
                value={formData.name}
                onChange={handleInputChange}
                placeholder="Enter product name"
                required
              />
            </div>
            
            <div className="form-group">
              <label htmlFor="description">Description</label>
              <textarea
                id="description"
                name="description"
                value={formData.description}
                onChange={handleInputChange}
                placeholder="Enter product description (optional)"
              />
            </div>
            
            <div className="form-row">
              <div className="form-group required">
                <label htmlFor="price">Price</label>
                <input
                  type="number"
                  id="price"
                  name="price"
                  step="0.01"
                  min="0"
                  value={formData.price}
                  onChange={handleInputChange}
                  placeholder="0.00"
                  required
                />
              </div>
              
              <div className="form-group required">
                <label htmlFor="stock_quantity">Stock Quantity</label>
                <input
                  type="number"
                  id="stock_quantity"
                  name="stock_quantity"
                  min="0"
                  value={formData.stock_quantity}
                  onChange={handleInputChange}
                  placeholder="0"
                  required
                />
              </div>
            </div>
            
            <div className="form-group required">
              <label htmlFor="sku">SKU</label>
              <input
                type="text"
                id="sku"
                name="sku"
                value={formData.sku}
                onChange={handleInputChange}
                placeholder="Enter unique product identifier"
                required
              />
            </div>
            
            <div className="form-group">
              <label htmlFor="image_url">Image URL</label>
              <input
                type="text"
                id="image_url"
                name="image_url"
                value={formData.image_url}
                onChange={handleInputChange}
                placeholder="https://example.com/image.jpg (optional)"
              />
            </div>
            
            <div className="form-group checkbox">
              <input
                type="checkbox"
                id="active"
                name="active"
                checked={formData.active}
                onChange={handleInputChange}
              />
              <label htmlFor="active">Active</label>
            </div>
            
            <div className="form-buttons">
              <button type="submit" className="btn-primary">
                {isEditing ? 'Update Product' : 'Add Product'}
              </button>
              {isEditing && (
                <button type="button" className="btn-secondary" onClick={resetForm}>
                  Cancel
                </button>
              )}
            </div>
            
            <p className="form-help-text">
              Fields marked with <span className="required-indicator">*</span> are required
            </p>
          </form>
        </div>
      ) : (
        <div className="inventory-view">
          <div className="inventory-header">
            <div className="inventory-actions">
              {/* Search bar - positioned left */}
              <div className="search-bar">
                <input
                  type="text"
                  value={searchTerm}
                  onChange={handleSearch}
                  placeholder="Search products..."
                  className="search-input"
                />
              </div>
              
              {/* Filter dropdown */}
              <div className="filter-container">
                <button 
                  type="button" 
                  className="btn-filter" 
                  onClick={toggleFilters}
                  aria-expanded={showFilters}
                >
                  <span>Filter</span>
                  {showFilters ? '▲' : '▼'}
                </button>
                
                {showFilters && (
                  <div className="filter-dropdown">
                    <h4>Filter Products</h4>
                    
                    <div className="filter-option">
                      <label>
                        Status:
                        <select 
                          name="status" 
                          value={filters.status}
                          onChange={handleFilterChange}
                          className="filter-select"
                        >
                          <option value="all">All Status</option>
                          <option value="active">Active</option>
                          <option value="inactive">Inactive</option>
                        </select>
                      </label>
                    </div>
                    
                    <div className="filter-option">
                      <label>
                        Stock:
                        <select 
                          name="stock" 
                          value={filters.stock}
                          onChange={handleFilterChange}
                          className="filter-select"
                        >
                          <option value="all">All Stock</option>
                          <option value="in-stock">In Stock</option>
                          <option value="out-of-stock">Out of Stock</option>
                        </select>
                      </label>
                    </div>
                    
                    <div className="filter-actions">
                      <button 
                        type="button" 
                        className="btn-filter-clear"
                        onClick={resetFilters}
                      >
                        Clear
                      </button>
                    </div>
                  </div>
                )}
              </div>
              
              <button 
                className="btn-add-product" 
                onClick={() => toggleView(true)}
              >
                Add New Product
              </button>
            </div>
          </div>
          
          <div className="products-list-container">
            
            {loading ? (
              <p>Loading products...</p>
            ) : filteredProducts.length === 0 ? (
              <p>No products found. {searchTerm ? 'Try a different search term.' : 'Click "Add New Product" to create your first product!'}</p>
            ) : (
              <>
                <table className="products-table">
                  <thead>
                    <tr>
                      <th>Image</th>
                      <th>Name</th>
                      <th>SKU</th>
                      <th>Price</th>
                      <th>Stock</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    {currentProducts.map((product) => (
                      <tr key={product.id}>
                        <td>
                          {product.image_url ? (
                            <img 
                              src={product.image_url} 
                              alt={product.name} 
                              className="product-thumbnail" 
                            />
                          ) : (
                            <div className="no-image">No Image</div>
                          )}
                        </td>
                        <td>{product.name}</td>
                        <td>{product.sku}</td>
                        <td>${Number(product.price).toFixed(2)}</td>
                        <td>{product.stock_quantity}</td>
                        <td>
                          <span className={`status-badge ${product.active ? 'active' : 'inactive'}`}>
                            {product.active ? 'Active' : 'Inactive'}
                          </span>
                        </td>
                        <td className="actions">
                          <button 
                            className="btn-edit" 
                            onClick={() => handleEdit(product)}
                          >
                            Edit
                          </button>
                          <button 
                            className="btn-delete" 
                            onClick={() => handleDelete(product.id)}
                          >
                            Delete
                          </button>
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
                
                {totalPages > 1 && (
                  <div className="pagination-controls">
                    <button 
                      className="btn-pagination"
                      onClick={() => paginate(currentPage - 1)}
                      disabled={currentPage === 1}
                    >
                      Previous
                    </button>
                    
                    <span className="pagination-info">
                      Page {currentPage} of {totalPages} ({filteredProducts.length} products)
                    </span>
                    
                    <button 
                      className="btn-pagination"
                      onClick={() => paginate(currentPage + 1)}
                      disabled={currentPage === totalPages}
                    >
                      Next
                    </button>
                  </div>
                )}
              </>
            )}
          </div>
        </div>
      )}
    </div>
  );
}

export default Products;