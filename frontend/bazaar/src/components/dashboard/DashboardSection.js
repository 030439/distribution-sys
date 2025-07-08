import React from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';

/**
 * Reusable component for displaying a section in the dashboard
 * with optional header action like "View All"
 */
function DashboardSection({ title, children, actionLink, actionText, onActionClick }) {
  return (
    <div className="dashboard-section">
      <div className="section-header">
        <h3>{title}</h3>
        {actionText && (
          onActionClick ? (
            <button onClick={onActionClick} className="view-all action-button">
              {actionText}
            </button>
          ) : actionLink && (
            <Link to={actionLink} className="view-all">
              {actionText}
            </Link>
          )
        )}
      </div>
      {children}
    </div>
  );
}

DashboardSection.propTypes = {
  title: PropTypes.string.isRequired,
  children: PropTypes.node.isRequired,
  actionLink: PropTypes.string,
  actionText: PropTypes.string,
  onActionClick: PropTypes.func
};

export default DashboardSection;
