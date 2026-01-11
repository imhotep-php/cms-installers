<?php

namespace Composer\Installers;

class ImhotepInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected $locations = array(
        'module'    => 'modules/{$vendor}-{$name}/',
        'plugin'    => 'plugins/{$vendor}-{$name}/',
        'theme'     => 'themes/{$vendor}-{$name}/'
    );

    /**
     * Format package name.
     *
     * For package type october-plugin, cut off a trailing '-plugin' if present.
     *
     * For package type october-theme, cut off a trailing '-theme' if present.
     */
    public function inflectPackageVars(array $vars): array
    {
        if ($vars['type'] === 'imhotep-module') {
            return $this->inflectModuleVars($vars);
        }

        if ($vars['type'] === 'imhotep-plugin') {
            return $this->inflectPluginVars($vars);
        }

        if ($vars['type'] === 'imhotep-theme') {
            return $this->inflectThemeVars($vars);
        }

        return $vars;
    }

    /**
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    protected function inflectModuleVars(array $vars): array
    {
        $vars['name'] = $this->pregReplace('/^cms|module$/', '', $vars['name']);
        $vars['name'] = $this->pregReplace('/^-+$/', '-', $vars['name']);
        $vars['vendor'] = $this->pregReplace('/[^a-z0-9_]/i', '', $vars['vendor']);

        return $vars;
    }

    /**
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    protected function inflectPluginVars(array $vars): array
    {
        $vars['name'] = $this->pregReplace('/^cms|plugin$/', '', $vars['name']);
        $vars['name'] = $this->pregReplace('/^-+$/', '-', $vars['name']);
        $vars['vendor'] = $this->pregReplace('/[^a-z0-9_]/i', '', $vars['vendor']);

        return $vars;
    }

    /**
     * @param array<string, string> $vars
     * @return array<string, string>
     */
    protected function inflectThemeVars(array $vars): array
    {
        $vars['name'] = $this->pregReplace('/^cms|theme$/', '', $vars['name']);
        $vars['name'] = $this->pregReplace('/^-+$/', '-', $vars['name']);
        $vars['vendor'] = $this->pregReplace('/[^a-z0-9_]/i', '', $vars['vendor']);

        return $vars;
    }
}