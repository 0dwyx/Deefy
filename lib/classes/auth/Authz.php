<?php

namespace iutnc\deefy\auth;

use iutnc\deefy\exception\AuthzException;

class Authz
{
    public static function checkRole(int $role): void
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] < $role) {
                throw new AuthzException("Rôle insuffisant");
            }
        } else {
            throw new AuthzException("Utilisateur non authentifié");
        }
    }

    public static function checkPlaylistOwner(int $id): void
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] < 100) {
                if ($_SESSION['id'] !== $id) {
                    throw new AuthzException("Playlist non autorisée");
                }
            }
        } else {
            throw new AuthzException("Utilisateur non authentifié");
        }
    }
}