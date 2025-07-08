import React, { createContext, useContext, useState } from 'react';
import PropTypes from 'prop-types';

// Create a context
const AppContext = createContext();

/**
 * AppProvider component to wrap the application and provide context
 */
export function AppProvider({ children }) {
  // Global application state
  const [user, setUser] = useState(null);
  const [notifications, setNotifications] = useState([]);
  const [darkMode, setDarkMode] = useState(false);
  
  // Handlers for updating state
  const addNotification = (notification) => {
    setNotifications(prev => [...prev, { id: Date.now(), ...notification }]);
  };
  
  const removeNotification = (id) => {
    setNotifications(prev => prev.filter(note => note.id !== id));
  };
  
  const toggleDarkMode = () => {
    setDarkMode(prev => !prev);
    // Could also save preference to localStorage here
  };
  
  const logout = () => {
    setUser(null);
    // Additional logout logic here
  };
  
  // Context value
  const value = {
    user,
    setUser,
    notifications,
    addNotification,
    removeNotification,
    darkMode,
    toggleDarkMode,
    logout
  };
  
  return <AppContext.Provider value={value}>{children}</AppContext.Provider>;
}

AppProvider.propTypes = {
  children: PropTypes.node.isRequired
};

/**
 * Custom hook to use the app context
 */
export function useAppContext() {
  const context = useContext(AppContext);
  
  if (context === undefined) {
    throw new Error('useAppContext must be used within an AppProvider');
  }
  
  return context;
}

export default AppContext;
