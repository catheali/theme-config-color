<?php
declare(strict_types=1);

namespace DevAlicia2\ThemeConfig\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use DevAlicia2\ThemeConfig\Model\ChangeColors;

class ColorConfig implements ArgumentInterface
{
    private ScopeConfigInterface $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function getPrimaryColor(): ?string
    {
        return $this->scopeConfig->getValue(
            ChangeColors::XML_PATH_PRIMARY_COLOR,
            ScopeInterface::SCOPE_STORE
        );
    }
}
