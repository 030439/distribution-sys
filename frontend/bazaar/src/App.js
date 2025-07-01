import './App.css';
import { useState } from 'react';
import { BrowserRouter as Router, Routes, Route, Link, NavLink, useLocation } from 'react-router-dom';

// page components
import Home from './pages/Home';
import Products from './pages/Products';
import Customers from './pages/Customers';
import Analytics from './pages/Analytics';
import Marketing from './pages/Marketing';
import Integrations from './pages/Integrations';
import Discounts from './pages/Discounts';
import Settings from './pages/Settings';

import Orders from './pages/Orders';

function Layout() {
  const location = useLocation();
  
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
            <NavLink to="/"><i className="icon-home"></i> Home</NavLink>
          </li>
          <li className={location.pathname === '/orders' ? 'active' : ''}>
            <NavLink to="/orders"><i className="icon-orders"></i> Orders</NavLink>
          </li>
          <li className={location.pathname === '/products' ? 'active' : ''}>
            <NavLink to="/products"><i className="icon-products"></i> Products</NavLink>
          </li>
          <li className={location.pathname === '/customers' ? 'active' : ''}>
            <NavLink to="/customers"><i className="icon-customers"></i> Customers</NavLink>
          </li>
          <li className={location.pathname === '/analytics' ? 'active' : ''}>
            <NavLink to="/analytics"><i className="icon-analytics"></i> Analytics</NavLink>
          </li>
          <li className={location.pathname === '/marketing' ? 'active' : ''}>
            <NavLink to="/marketing"><i className="icon-marketing"></i> Marketing</NavLink>
          </li>
          <li className={location.pathname === '/integrations' ? 'active' : ''}>
            <NavLink to="/integrations"><i className="icon-integrations"></i> Integrations</NavLink>
          </li>
          <li className={location.pathname === '/discounts' ? 'active' : ''}>
            <NavLink to="/discounts"><i className="icon-discounts"></i> Discounts</NavLink>
          </li>
          <li className={`bottom-menu-item ${location.pathname === '/settings' ? 'active' : ''}`}>
            <NavLink to="/settings"><i className="icon-settings"></i> Settings</NavLink>
          </li>
        </ul>
      </div>
      
      <div className="main-content">
        <div className="top-bar">
          <div className="search-container">
            <i className="icon-search"></i>
            <input type="text" placeholder="Search..." className="global-search" />
          </div>
          <div className="user-profile">
            <img src="/avatar.jpg" alt="Profile" className="avatar" />
          </div>
        </div>

        {/* pge content rendering */}
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
      </div>
    </div>
  );
}

function App() {
  return (
    <Router>
      <Layout />
    </Router>
  );
}

export default App;
