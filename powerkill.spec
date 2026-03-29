Name:           powerkill
Version:        2.3
Release:        1%{?dist}
Summary:        Brutal signal-storm utility for testing process robustness

License:        MIT
URL:            https://github.com/Willtech/Powerkill
Source0:        %{name}-%{version}.tar.gz

# Disable debug packages (required for shc-generated C)
%global debug_package %{nil}

BuildRequires:  bash
BuildRequires:  shc
BuildRequires:  gcc
BuildRequires:  coreutils
BuildRequires:  gzip

BuildArch:      x86_64

%description
Powerkill iterates through kill -n 1..65536 against a target PID, suppressing
output. Useful for stress-testing, debugging, or force-terminating stubborn
processes. This package builds Powerkill from source using the shc → gcc
pipeline to produce a compiled binary.

%prep
%setup -q

%build
chmod +x install.bin
./install.bin

# After install.bin runs, the compiled binary MUST exist as powerkill.bin
if [ ! -f powerkill.bin ]; then
    echo "ERROR: powerkill.bin was not produced by install.bin"
    exit 1
fi

%install
mkdir -p %{buildroot}/usr/bin
mkdir -p %{buildroot}/usr/share/man/man8

# Install compiled binary (rename to final name)
install -m 0755 powerkill.bin %{buildroot}/usr/bin/powerkill

# Install man page
install -m 0644 powerkill.8 %{buildroot}/usr/share/man/man8/powerkill.8

%files
%license LICENCE
%doc README.md
/usr/bin/powerkill
/usr/share/man/man8/powerkill.8*

%changelog
* Sun Mar 29 2026 MR. Damian A. James Williamson <willtech@live.com.au> - 2.3-1
- Build using install.bin and install powerkill.bin → /usr/bin/powerkill
