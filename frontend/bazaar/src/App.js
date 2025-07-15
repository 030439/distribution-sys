import './App.css';
import './components/components.css';
import './theme/DarkMode.css';  // Import dark mode styles
import { useState, lazy, Suspense, useEffect } from 'react';
import { BrowserRouter as Router, Routes, Route, NavLink, useLocation } from 'react-router-dom';
import { AppProvider, useAppContext } from './context/AppContext';
import NotificationList from './components/NotificationList';

// Lazy loaded page components for better performance
const Home = lazy(() => import('./pages/Home'));
const Products = lazy(() => import('./pages/Products'));
const Customers = lazy(() => import('./pages/Customers'));
const Analytics = lazy(() => import('./pages/Analytics'));
const Marketing = lazy(() => import('./pages/Marketing'));
const Integrations = lazy(() => import('./pages/Integrations'));
const Discounts = lazy(() => import('./pages/Discounts'));
const Settings = lazy(() => import('./pages/Settings'));
const Orders = lazy(() => import('./pages/Orders'));

function Layout() {
  const location = useLocation();
  // Access darkMode from context
  const { darkMode, toggleDarkMode } = useAppContext();
  
  // Apply dark mode class to body
  useEffect(() => {
    if (darkMode) {
      document.body.classList.add('dark-mode');
    } else {
      document.body.classList.remove('dark-mode');
    }
  }, [darkMode]);
  
  return (
    <div className="App">
      <div className="sidebar">
        <div className="sidebar-header">
          <div className="logo">
            <span className="logo-icon">Ba</span>
            <span className="logo-text">Bazaar</span>
          </div>
        </div>
        <ul className="sidebar-menu">
          <li className={location.pathname === '/' ? 'active' : ''}>
            <NavLink to="/">Home</NavLink>
          </li>
          <li className={location.pathname === '/orders' ? 'active' : ''}>
            <NavLink to="/orders">Orders</NavLink>
          </li>
          <li className={location.pathname === '/products' ? 'active' : ''}>
            <NavLink to="/products">Products</NavLink>
          </li>
          <li className={location.pathname === '/customers' ? 'active' : ''}>
            <NavLink to="/customers">Customers</NavLink>
          </li>
          <li className={location.pathname === '/analytics' ? 'active' : ''}>
            <NavLink to="/analytics">Analytics</NavLink>
          </li>
          <li className={location.pathname === '/marketing' ? 'active' : ''}>
            <NavLink to="/marketing">Marketing</NavLink>
          </li>
          <li className={location.pathname === '/integrations' ? 'active' : ''}>
            <NavLink to="/integrations">Integrations</NavLink>
          </li>
          <li className={location.pathname === '/discounts' ? 'active' : ''}>
            <NavLink to="/discounts">Discounts</NavLink>
          </li>
          <li className={`bottom-menu-item ${location.pathname === '/settings' ? 'active' : ''}`}>
            <NavLink to="/settings">Settings</NavLink>
          </li>
        </ul>
      </div>
      
      <div className="main-content">
        <div className="top-bar">
          <div className="search-container">
            <i className="icon-search"></i>
            <input type="text" placeholder="Search..." className="global-search" />
          </div>
          <div className="user-actions">
            <button 
              onClick={toggleDarkMode}
              className="theme-toggle"
              aria-label="Toggle dark mode"
              title={darkMode ? "Switch to light mode" : "Switch to dark mode"}
            >
              {darkMode ? "☀️" : "🌙"}
            </button>
            <div className="user-profile">
              <img src="/avatar.jpg" alt="Profile" className="avatar" />
            </div>
          </div>
        </div>

        {/* Loading indicator for lazy-loaded components */}
        <Suspense fallback={
          <div className="app-loading">
            <div className="spinner"></div>
          </div>
        }>
          {/* Page content rendering */}
          <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/orders" element={<Orders />} />
            <Route path="/products" element={<Products />} />
            <Route path="/customers" element={<Customers />} />
            <Route path="/analytics" element={<Analytics />} />
            <Route path="/marketing" element={<Marketing />} />
            <Route path="/integrations" element={<Integrations />} />
            <Route path="/discounts" element={<Discounts />} />
            <Route path="/settings" element={<Settings />} />
          </Routes>
        </Suspense>
      </div>
    </div>
  );
}

function App() {
  return (
    <AppProvider>
      <Router>
        <NotificationList />
        <Layout />
      </Router>
    </AppProvider>
  );
}

export default App;
