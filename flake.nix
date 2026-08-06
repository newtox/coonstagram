{
  description = "Coonstagram – Laravel Dev Environment";

  inputs = {
    nixpkgs.url = "github:NixOS/nixpkgs/nixos-unstable";
    flake-utils.url = "github:numtide/flake-utils";
  };

  outputs = { self, nixpkgs, flake-utils }:
    flake-utils.lib.eachDefaultSystem (system:
      let
        pkgs = import nixpkgs { inherit system; };

        php = pkgs.php84.withExtensions ({ enabled, all }: enabled ++ (with all; [
          pdo_sqlite
          sqlite3
          mbstring
          zip
          bcmath
          intl
          fileinfo
        ]));
      in
      {
        devShells.default = pkgs.mkShell {
          buildInputs = [
            php
            php.packages.composer
            pkgs.nodejs
            pkgs.sqlite
          ];

          shellHook = ''
            echo "🦝 Coonstagram Dev-Shell aktiv"
            echo "PHP: $(php --version | head -n1)"
            echo "Node: $(node --version)"
            echo "Composer: $(composer --version)"
          '';
        };
      });
}