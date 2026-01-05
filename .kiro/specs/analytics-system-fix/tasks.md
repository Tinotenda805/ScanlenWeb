# Implementation Plan: Analytics System Fix

## Overview

This implementation plan addresses the critical issues preventing the analytics system from capturing visitor data. The tasks are ordered to fix the most fundamental issues first, then validate the system is working correctly.

## Tasks

- [x] 1. Fix middleware registration in bootstrap configuration
  - Update `bootstrap/app.php` to properly register TrackPageViews middleware
  - Ensure middleware is applied to web routes only, not API routes
  - _Requirements: 1.1, 1.2, 1.3, 1.4_

- [ ]* 1.1 Write unit test for middleware registration
  - Test that middleware is properly registered in the application
  - _Requirements: 1.1_

- [ ] 2. Verify and run database migrations
  - Check if analytics tables exist in the database
  - Run the analytics migration if tables are missing
  - Verify table structure matches model expectations
  - _Requirements: 3.1, 3.4_

- [ ]* 2.1 Write property test for database table verification
  - **Property 7: Data persistence**
  - **Validates: Requirements 3.2, 4.1, 4.2**

- [ ] 3. Fix session handling in TrackPageViews middleware
  - Enhance session initialization logic to handle edge cases
  - Add proper error handling for session failures
  - Remove unused imports (Response, Str) to clean up code
  - _Requirements: 2.1, 2.4_

- [ ]* 3.1 Write property test for session initialization
  - **Property 4: Session initialization**
  - **Validates: Requirements 2.1**

- [ ]* 3.2 Write property test for graceful error handling
  - **Property 6: Graceful error handling**
  - **Validates: Requirements 2.4, 3.3, 5.5**

- [ ] 4. Ensure CSRF token is available in layouts
  - Add CSRF meta tag to main layout files
  - Verify token is accessible to JavaScript analytics tracker
  - _Requirements: 2.2, 2.3_

- [ ]* 4.1 Write unit test for CSRF token availability
  - Test that CSRF token is present in page HTML
  - _Requirements: 2.2_

- [ ]* 4.2 Write property test for CSRF token authentication
  - **Property 5: CSRF token authentication**
  - **Validates: Requirements 2.3**

- [ ] 5. Checkpoint - Test basic page view tracking
  - Manually test that visiting a public page creates database records
  - Verify admin pages are excluded from tracking
  - Ensure all tests pass, ask the user if questions arise

- [x] 6. Fix JavaScript analytics tracker integration
  - Enhance CSRF token retrieval with fallback methods
  - Improve error handling for failed API calls
  - Test tracker initialization and API communication
  - _Requirements: 5.1, 5.2, 5.3, 5.4, 5.5_

- [ ]* 6.1 Write property test for public page tracking
  - **Property 1: Public page tracking**
  - **Validates: Requirements 1.2, 4.1**

- [ ]* 6.2 Write property test for admin page exclusion
  - **Property 2: Admin page exclusion**
  - **Validates: Requirements 1.3**

- [ ]* 6.3 Write property test for API request exclusion
  - **Property 3: API request exclusion**
  - **Validates: Requirements 1.4**

- [ ] 7. Implement click event tracking validation
  - Test click event API endpoint functionality
  - Verify click events are properly stored in database
  - Test JavaScript click tracking integration
  - _Requirements: 4.2, 5.2_

- [ ]* 7.1 Write property test for click event tracking
  - **Property 8: Click event tracking**
  - **Validates: Requirements 4.2, 5.2**

- [ ] 8. Validate session metrics and time tracking
  - Test session duration and page count updates
  - Verify time-on-page tracking works correctly
  - Test device and location information capture
  - _Requirements: 4.3, 4.4, 4.5, 5.3_

- [ ]* 8.1 Write property test for session metrics updates
  - **Property 9: Session metrics updates**
  - **Validates: Requirements 4.3**

- [ ]* 8.2 Write property test for device information capture
  - **Property 10: Device information capture**
  - **Validates: Requirements 4.5**

- [ ]* 8.3 Write property test for time tracking updates
  - **Property 11: Time tracking updates**
  - **Validates: Requirements 5.3**

- [ ] 9. Test analytics dashboard integration
  - Verify dashboard displays captured analytics data
  - Test data export functionality
  - Ensure proper handling of empty states
  - _Requirements: 6.1, 6.2, 6.3, 6.4_

- [ ]* 9.1 Write unit tests for dashboard functionality
  - Test dashboard data display and export features
  - _Requirements: 6.1, 6.2, 6.3, 6.4_

- [ ] 10. Final validation and cleanup
  - Run comprehensive tests across different browsers
  - Verify no tracking occurs in admin areas
  - Test error scenarios and graceful degradation
  - Clean up any remaining code issues
  - _Requirements: All_

- [ ] 11. Final checkpoint - Ensure all tests pass
  - Ensure all tests pass, ask the user if questions arise

## Notes

- Tasks marked with `*` are optional and can be skipped for faster MVP
- Each task references specific requirements for traceability
- Checkpoints ensure incremental validation
- Property tests validate universal correctness properties
- Unit tests validate specific examples and edge cases
- Focus on getting basic tracking working first, then add comprehensive testing