<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Mail;

use Spryker\Zed\AvailabilityNotification\Communication\Plugin\Mail\AvailabilityNotificationMailTypeBuilderPlugin;
use Spryker\Zed\AvailabilityNotification\Communication\Plugin\Mail\AvailabilityNotificationMailTypePlugin;
use Spryker\Zed\AvailabilityNotification\Communication\Plugin\Mail\AvailabilityNotificationSubscriptionMailTypeBuilderPlugin;
use Spryker\Zed\AvailabilityNotification\Communication\Plugin\Mail\AvailabilityNotificationSubscriptionMailTypePlugin;
use Spryker\Zed\AvailabilityNotification\Communication\Plugin\Mail\AvailabilityNotificationUnsubscribedMailTypeBuilderPlugin;
use Spryker\Zed\AvailabilityNotification\Communication\Plugin\Mail\AvailabilityNotificationUnsubscribedMailTypePlugin;
use Spryker\Zed\CompanyMailConnector\Communication\Plugin\Mail\CompanyStatusMailTypeBuilderPlugin;
use Spryker\Zed\CompanyMailConnector\Communication\Plugin\Mail\CompanyStatusMailTypePlugin;
use Spryker\Zed\CompanyUserInvitation\Communication\Plugin\Mail\CompanyUserInvitationMailTypeBuilderPlugin;
use Spryker\Zed\CompanyUserInvitation\Communication\Plugin\Mail\CompanyUserInvitationMailTypePlugin;
use Spryker\Zed\Customer\Communication\Plugin\Mail\CustomerRegistrationConfirmationMailTypeBuilderPlugin;
use Spryker\Zed\Customer\Communication\Plugin\Mail\CustomerRegistrationConfirmationMailTypePlugin;
use Spryker\Zed\Customer\Communication\Plugin\Mail\CustomerRegistrationMailTypeBuilderPlugin;
use Spryker\Zed\Customer\Communication\Plugin\Mail\CustomerRegistrationMailTypePlugin;
use Spryker\Zed\Customer\Communication\Plugin\Mail\CustomerRestorePasswordMailTypeBuilderPlugin;
use Spryker\Zed\Customer\Communication\Plugin\Mail\CustomerRestorePasswordMailTypePlugin;
use Spryker\Zed\Customer\Communication\Plugin\Mail\CustomerRestoredPasswordConfirmationMailTypeBuilderPlugin;
use Spryker\Zed\Customer\Communication\Plugin\Mail\CustomerRestoredPasswordConfirmationMailTypePlugin;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Mail\Business\Model\Mail\MailTypeCollectionAddInterface;
use Spryker\Zed\Mail\Business\Model\Provider\MailProviderCollectionAddInterface;
use Spryker\Zed\Mail\Communication\Plugin\MailProviderPlugin;
use Spryker\Zed\Mail\MailConfig;
use Spryker\Zed\Mail\MailDependencyProvider as SprykerMailDependencyProvider;
use Spryker\Zed\Newsletter\Communication\Plugin\Mail\NewsletterSubscribedMailTypeBuilderPlugin;
use Spryker\Zed\Newsletter\Communication\Plugin\Mail\NewsletterSubscribedMailTypePlugin;
use Spryker\Zed\Newsletter\Communication\Plugin\Mail\NewsletterUnsubscribedMailTypeBuilderPlugin;
use Spryker\Zed\Newsletter\Communication\Plugin\Mail\NewsletterUnsubscribedMailTypePlugin;
use Spryker\Zed\Oms\Communication\Plugin\Mail\OrderConfirmationMailTypeBuilderPlugin;
use Spryker\Zed\Oms\Communication\Plugin\Mail\OrderConfirmationMailTypePlugin;
use Spryker\Zed\Oms\Communication\Plugin\Mail\OrderShippedMailTypeBuilderPlugin;
use Spryker\Zed\Oms\Communication\Plugin\Mail\OrderShippedMailTypePlugin;
use Spryker\Zed\SalesInvoice\Communication\Plugin\Mail\OrderInvoiceMailTypeBuilderPlugin;
use Spryker\Zed\SalesInvoice\Communication\Plugin\Mail\OrderInvoiceMailTypePlugin;
use Spryker\Zed\UserPasswordResetMail\Communication\Plugin\Mail\UserPasswordResetMailTypeBuilderPlugin;
use Spryker\Zed\UserPasswordResetMail\Communication\Plugin\Mail\UserPasswordResetMailTypePlugin;

class MailDependencyProvider extends SprykerMailDependencyProvider
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container->extend(static::MAIL_TYPE_COLLECTION, function (MailTypeCollectionAddInterface $mailCollection) {
            $mailCollection
                ->add(new CustomerRegistrationMailTypePlugin())
                ->add(new CustomerRegistrationConfirmationMailTypePlugin())
                ->add(new CustomerRestorePasswordMailTypePlugin())
                ->add(new CustomerRestoredPasswordConfirmationMailTypePlugin())
                ->add(new NewsletterSubscribedMailTypePlugin())
                ->add(new NewsletterUnsubscribedMailTypePlugin())
                ->add(new OrderConfirmationMailTypePlugin())
                ->add(new OrderShippedMailTypePlugin())
                ->add(new CompanyUserInvitationMailTypePlugin())
                ->add(new CompanyStatusMailTypePlugin())
                ->add(new AvailabilityNotificationUnsubscribedMailTypePlugin())
                ->add(new AvailabilityNotificationSubscriptionMailTypePlugin())
                ->add(new AvailabilityNotificationMailTypePlugin())
                ->add(new UserPasswordResetMailTypePlugin())
                ->add(new OrderInvoiceMailTypePlugin());

            return $mailCollection;
        });

        $container->extend(self::MAIL_PROVIDER_COLLECTION, function (MailProviderCollectionAddInterface $mailProviderCollection) {
            $mailProviderCollection
                ->addProvider(new MailProviderPlugin(), [
                    MailConfig::MAIL_TYPE_ALL,
                    CompanyUserInvitationMailTypePlugin::MAIL_TYPE,
                ]);

            return $mailProviderCollection;
        });

        return $container;
    }
    /**
     * @return array<\Spryker\Zed\MailExtension\Dependency\Plugin\MailTypeBuilderPluginInterface>
     */
    protected function getMailTypeBuilderPlugins() : array
    {
        return [
            new AvailabilityNotificationUnsubscribedMailTypeBuilderPlugin(),
            new AvailabilityNotificationSubscriptionMailTypeBuilderPlugin(),
            new AvailabilityNotificationMailTypeBuilderPlugin(),
            new CompanyStatusMailTypeBuilderPlugin(),
            new CompanyUserInvitationMailTypeBuilderPlugin(),
            new CustomerRegistrationMailTypeBuilderPlugin(),
            new CustomerRegistrationConfirmationMailTypeBuilderPlugin(),
            new CustomerRestorePasswordMailTypeBuilderPlugin(),
            new CustomerRestoredPasswordConfirmationMailTypeBuilderPlugin(),
            new NewsletterSubscribedMailTypeBuilderPlugin(),
            new NewsletterUnsubscribedMailTypeBuilderPlugin(),
            new OrderConfirmationMailTypeBuilderPlugin(),
            new OrderShippedMailTypeBuilderPlugin(),
            new OrderInvoiceMailTypeBuilderPlugin(),
            new UserPasswordResetMailTypeBuilderPlugin(),
        ];
    }
}
