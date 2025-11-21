<?php
declare(strict_types=1);

namespace DevAlicia2\ThemeConfig\Model;

use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Store\Model\StoreRepository;
use InvalidArgumentException;
use Magento\Store\Model\ScopeInterface;

class ChangeColors
{
    const XML_PATH_PRIMARY_COLOR = 'devalicia2/theme/primary_color';

    private WriterInterface $configWriter;
    private StoreRepository $storeRepository;
    private TypeListInterface $cacheTypeList;

    public function __construct(
        WriterInterface $configWriter,
        StoreRepository $storeRepository,
        TypeListInterface $cacheTypeList
    ) {
        $this->configWriter = $configWriter;
        $this->storeRepository = $storeRepository;
        $this->cacheTypeList = $cacheTypeList;
    }

    /**
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws InvalidArgumentException
     */
    public function changeColorPrimary(string $hex, int $storeId): bool
    {

        $this->storeRepository->getById($storeId);

        $validHex = $this->normalizeHex($hex);

        $this->configWriter->save(
            self::XML_PATH_PRIMARY_COLOR,
            $validHex,
            ScopeInterface::SCOPE_STORES,
            $storeId
        );

        $this->cacheTypeList->cleanType('config');

        return true;
    }

    private function normalizeHex(string $hex): string
    {
        $hex = ltrim($hex, "#");

        if (!preg_match('/^([0-9a-f]{6}|[0-9a-f]{3})$/i', $hex)) {
            throw new InvalidArgumentException("Cor HEX inválida: #{$hex}");
        }

        return "#" . strtolower($hex);
    }
}
