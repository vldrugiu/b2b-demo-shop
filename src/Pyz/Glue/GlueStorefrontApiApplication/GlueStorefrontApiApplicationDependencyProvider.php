<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\GlueStorefrontApiApplication;

use Spryker\Glue\GlueStorefrontApiApplication\GlueStorefrontApiApplicationDependencyProvider as SprykerGlueStorefrontApiApplicationDependencyProvider;
use Spryker\Glue\GlueStorefrontApiApplication\Plugin\GlueApplication\ApplicationIdentifierRequestBuilderPlugin;
use Spryker\Glue\GlueStorefrontApiApplication\Plugin\GlueApplication\LocaleRequestBuilderPlugin;
use Spryker\Glue\GlueStorefrontApiApplication\Plugin\GlueApplication\RequestCorsValidatorPlugin;
use Spryker\Glue\GlueStorefrontApiApplication\Plugin\GlueApplication\ScopeRequestAfterRoutingValidatorPlugin;
use Spryker\Glue\GlueStorefrontApiApplication\Plugin\GlueApplication\SecurityHeaderResponseFormatterPlugin;

class GlueStorefrontApiApplicationDependencyProvider extends SprykerGlueStorefrontApiApplicationDependencyProvider
{
    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RequestBuilderPluginInterface>
     */
    protected function getRequestBuilderPlugins() : array
    {
        return [
            new ApplicationIdentifierRequestBuilderPlugin(),
            new LocaleRequestBuilderPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\RequestAfterRoutingValidatorPluginInterface>
     */
    protected function getRequestAfterRoutingValidatorPlugins() : array
    {
        return [
            new RequestCorsValidatorPlugin(),
            new ScopeRequestAfterRoutingValidatorPlugin(),
        ];
    }

    /**
     * @return array<\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResponseFormatterPluginInterface>
     */
    protected function getResponseFormatterPlugins() : array
    {
        return [
            new SecurityHeaderResponseFormatterPlugin(),
        ];
    }
}