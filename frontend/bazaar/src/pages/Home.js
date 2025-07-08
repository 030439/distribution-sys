import React, { useState } from 'react';
import './BazaarTheme.css';
import './Home.css';

// Reusable components
import StatCard from '../components/dashboard/StatCard';
import DashboardSection from '../components/dashboard/DashboardSection';
import ProductsTable from '../components/dashboard/ProductsTable';
import QuickActions from '../components/dashboard/QuickActions';

// Custom hooks
import useProducts from '../hooks/useProducts';
import { useAppContext } from '../context/AppContext';

// API service
import { productAPI } from '../services/api';

function Home() {
  // State to track if we should show all products or just limited ones
  // useState(false) creates a state variable that starts with the value false
  // showAllProducts = current state value, setShowAllProducts = function to update it
  const [showAllProducts, setShowAllProducts] = useState(false);
  
  // Custom hook that fetches product data from the API and returns multiple values
  // This is a reusable piece of logic that can be used in any component
  // - products: array of product objects from the database
  // - loading: boolean indicating if data is still being fetched
  // - error: any error message that occurred during fetching
  // - stats: calculated statistics about the products
  const { products, loading, error, stats } = useProducts({ 
    limit: showAllProducts ? null : 5,  // If showAllProducts is true, get all products, otherwise just 5
    calculateStats: true                // Tell the hook to calculate statistics like totalRevenue
  });
  
  // Use the global context to access shared functionality
  // addNotification is a function that displays messages to the user
  // This function comes from AppContext.js and is available throughout the app
  const { addNotification } = useAppContext();
  
  // Define quick action items - this array will be passed as a prop to the QuickActions component
  // Each object represents one action button with its own properties:
  // - icon: The visual element shown on the button
  // - label: The text shown below the icon
  // - link: Where the button should navigate to when clicked
  // - bgColor: The background color for the icon
  const actionItems = [
    {
      icon: <span className="icon">+</span>,
      label: 'Add Product',
      link: '/products',
      bgColor: 'var(--bazaar-orange)'  // Using a CSS variable defined in BazaarTheme.css
    },
    {
      icon: <span className="icon">🛒</span>,
      label: 'View Orders',
      link: '/orders',
      bgColor: '#3498db'  // Direct color values can also be used
    },
    {
      icon: <span className="icon">👥</span>,
      label: 'Customers',
      link: '/customers',
      bgColor: '#9b59b6'
    },
    {
      icon: <span className="icon">📊</span>,
      label: 'Analytics',
      link: '/analytics',
      bgColor: '#27ae60'
    }
  ];
  
  // Function to handle the "Refresh Data" button click
  // This is an example of using both the API service and the context system
  const handleRefreshData = async () => {
    try {
      // Call the API service to fetch fresh product data
      // This is an abstraction that handles the fetch request for us
      await productAPI.getAll();
      
      // Use the addNotification function from our global context
      // to show a success message to the user
      addNotification({ 
        type: 'success',  // Type determines the styling (green for success)
        message: 'Dashboard data refreshed!' 
      });
    } catch (err) {
      // If anything goes wrong, show an error notification instead
      // This provides consistent error handling across the app
      addNotification({ 
        type: 'error',  // Type determines the styling (red for errors)
        message: 'Failed to refresh data' 
      });
    }
  };

  // The render section - where the JSX defines what gets displayed on screen
  return (
    <div className="home-container">
      {/* Dashboard header with title and refresh button */}
      <div className="dashboard-header">
        <div>
          <h2>Dashboard</h2>
        </div>
        {/* The onClick handler calls our handleRefreshData function when clicked */}
        <button onClick={handleRefreshData} className="refresh-btn">
          Refresh Data
        </button>
      </div>
      
      {/* Conditional rendering: only show error alert if there is an error */}
      {error && (
        <div className="error-alert">
          {error}
        </div>
      )}
      
      {/* Conditional rendering with ternary operator: 
          If loading=true, show loading message
          Otherwise, show the dashboard content */}
      {loading ? (
        <div className="loading">Loading dashboard data...</div>
      ) : (
        <>  {/* React Fragment - groups elements without adding extra DOM nodes */}
          {/* StatCard components for displaying key metrics */}
          <div className="stats-grid">
            <StatCard 
              title="Total Products" 
              value={stats.totalProducts} 
              icon={<span className="icon">📦</span>} 
              iconBgColor="var(--bazaar-orange)" 
            />
            
            <StatCard 
              title="Inventory Value" 
              value={`$${stats.totalRevenue.toFixed(2)}`} 
              icon={<span className="icon">$</span>} 
              iconBgColor="#27ae60" 
            />
            
            <StatCard 
              title="Low Stock Items" 
              value={stats.lowStock} 
              icon={<span className="icon">⚠️</span>} 
              iconBgColor="#e67e22" 
            />
            
            <StatCard 
              title="Active Products" 
              value={stats.activeProducts} 
              icon={<span className="icon">✓</span>} 
              iconBgColor="#3498db" 
            />
          </div>
          
          {/* Recent Products */}
          <DashboardSection 
            title={showAllProducts ? "All Products" : "Recent Products"}
            actionText={showAllProducts ? "Show Less" : "View All"}
            onActionClick={() => setShowAllProducts(!showAllProducts)}
          >
            <ProductsTable 
              products={products} 
              isLoading={loading} 
            />
          </DashboardSection>
          
          {/* Quick Actions */}
          <DashboardSection title="Quick Actions">
            <QuickActions actions={actionItems} />
          </DashboardSection>
        </>
      )}
    </div>
  );
}

export default Home;