## Unreleased

### Added

-   Nothing

### Changed

-   Nothing

### Deprecated

-   Nothing

### Removed

-   Nothing

### Fixed

-   Database username being sanitised during installation causing a mismatch between input and actual credentials (#212)

### Security

-   Added a check to disable database testing (`/index.php?page=api&module=database-test`) after wishthis has been installed - Thanks [@kumitterer](https://github.com/kumitterer)!
