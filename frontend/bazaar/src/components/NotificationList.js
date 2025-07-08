import React from 'react';
import PropTypes from 'prop-types';
import { useAppContext } from '../context/AppContext';

/**
 * A reusable notification component that displays alerts from the global context
 */
function NotificationList() {
  const { notifications, removeNotification } = useAppContext();

  if (notifications.length === 0) {
    return null;
  }

  return (
    <div className="notifications-container">
      {notifications.map((notification) => (
        <div 
          key={notification.id} 
          className={`notification notification-${notification.type || 'info'}`}
        >
          <div className="notification-message">{notification.message}</div>
          <button 
            className="notification-close"
            onClick={() => removeNotification(notification.id)}
          >
            &times;
          </button>
        </div>
      ))}
    </div>
  );
}

export default NotificationList;
